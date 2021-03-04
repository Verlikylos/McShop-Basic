<?php

namespace App\Models;

use App\Enums\PaymentType;
use Facade\FlareClient\Http\Exceptions\BadResponse;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use xPaw\SourceQuery\SourceQuery;

/**
 * App\Models\Service
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $server_id
 * @property string $image_url
 * @property string $description
 * @property bool $requires_online_player
 * @property array $commands
 * @property int $smsnumber_id
 * @property int $psc_cost
 * @property int $transfer_cost
 * @property int $paypal_cost
 */
class Service extends Model
{
    public $timestamps = false;

    protected $casts = [
        'requires_online_player' => 'boolean',
        'commands' => 'array',
        'active' => 'boolean'
    ];

    protected $guarded = [];

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getImageUrl(): string
    {
        return $this->image_url;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getFormattedDescription(): string
    {
        return app(\Parsedown::class)->setSafeMode(true)->text($this->description);
    }

    public function requiresOnlinePlayer(): bool
    {
        return $this->requires_online_player;
    }

    public function getCommands(): array
    {
        return $this->commands;
    }

    public function getCostRaw(string $paymentType) {
        switch ($paymentType) {
            case PaymentType::SMS:
                if (self::getSmsNumber() === null) {
                    return null;
                }

                return self::getSmsNumber()->getBruttoCostRaw();
            case PaymentType::PSC:
                return self::getPscCostRaw() ?? 0;
            case PaymentType::TRANSFER:
                return self::getTransferCostRaw() ?? 0;
            case PaymentType::PAYPAL:
                return self::getPayPalCostRaw() ?? 0;
        }
    }

    public function getPscCostRaw(): ?int
    {
        return $this->psc_cost;
    }

    public function getPscCost(): ?float
    {
        if ($this->psc_cost === null) {
            return null;
        }

        return round((float) $this->psc_cost / 100, 2);
    }

    public function getPscCostFormatted(): ?string
    {
        if ($this->psc_cost === null) {
            return null;
        }

        return number_format($this->getPscCost(), 2, ',', ' ');
    }

    public function getTransferCostRaw(): ?int
    {
        return $this->transfer_cost;
    }

    public function getTransferCost(): ?float
    {
        if ($this->transfer_cost === null) {
            return null;
        }

        return round((float) $this->transfer_cost / 100, 2);
    }

    public function getTransferCostFormatted(): ?string
    {
        if ($this->transfer_cost === null) {
            return null;
        }

        return number_format($this->getTransferCost(), 2, ',', ' ');
    }

    public function getPaypalCostRaw(): int
    {
        return $this->paypal_cost;
    }

    public function getPaypalCost(): ?float
    {
        if ($this->paypal_cost === null) {
            return null;
        }

        return round((float) $this->paypal_cost / 100, 2);
    }

    public function getPaypalCostFormatted(): ?string
    {
        if ($this->paypal_cost === null) {
            return null;
        }

        return number_format($this->getPaypalCost(), 2, ',', ' ');
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function getSortId(): int
    {
        return $this->sort_id;
    }

    public function server()
    {
        return $this->belongsTo(Server::class, 'server_id', 'id');
    }

    public function getServer(): Server
    {
        return $this->server;
    }

    public function smsnumber()
    {
        return $this->belongsTo(SmsNumber::class, 'smsnumber_id', 'id');
    }

    public function getSmsNumber(): ?SmsNumber
    {
        return $this->smsnumber;
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class, 'service_id', 'id');
    }

    public function getVouchers(): Collection
    {
        return $this->vouchers;
    }

    public function redeem(string $playerName = null): bool {
        $commands = [];

        if ($playerName !== null) {
            foreach ($this->commands as $command) {
                $commands[] = str_replace('{PLAYER}', $playerName, $command);
            }
        } else {
            $commands = $this->commands;
        }

        if (empty($commands)) {
            throw new \Exception('Service does not contain any commands');
        }

        if ($this->server->getConnectionMethod() == 'rcon') {
            $client = new SourceQuery();

            $client->Connect($this->server->getIpAddress(), $this->server->getRconPort(), 5, SourceQuery::SOURCE);
            $client->SetRconPassword($this->server->getRconPassword());

            foreach ($commands as $command) {
                $client->Rcon($command);
            }

            $client->Disconnect();

            return true;
        }

        $data = [
            'commands' => $commands
        ];

        $params = [
            'service' => 'mcshop',
            'data' => $data,
            'signature' => hash_hmac("sha256", json_encode($data), $this->server->getApiKey())
        ];

        $url = $this->server->getApiAddress() . '/execute/command';
        $response = Http::withToken($this->server->getApiKey())->post($url, $params);

        if (!$response->ok()) {
            throw new BadResponse('Server responded with ' . $response->status() . ' status code');
        }

        $responseData = $response->json();

        if (empty($responseData) && (!empty($this->commands))) {
            throw new BadResponse('Empty response');
        }

        foreach ($responseData as $command) {
            if (!isset($command['execute'])) {
                throw new \Exception('One or more commands failed to execute');
            }

            if (!$command['execute']) {
                throw new \Exception('One or more commands failed to execute');
            }
        }

        return true;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }


    public function getAvailablePaymentBadges(): array
    {
        $badges = [];

        if ($this->getSmsNumber() !== null) {
            $badges[] = $this->makeBadge('sms');
        }

        if ($this->getPscCost() !== null) {
            $badges[] = $this->makeBadge('psc');
        }

        if ($this->getTransferCost() !== null) {
            $badges[] = $this->makeBadge('transfer');
        }

        if ($this->getPaypalCost() !== null) {
            $badges[] = $this->makeBadge('paypal');
        }

        return $badges;
    }

    private function makeBadge($payment = 'sms'): ?string
    {
        $paymentMethods = config('mcshop.payment_methods');

        if (!in_array($payment, array_keys($paymentMethods))) {
            return null;
        }

        return '<span class="badge badge-' . $paymentMethods[$payment]['color'] . '">' . $paymentMethods[$payment]['displayname'] . '</span>';
    }
}
