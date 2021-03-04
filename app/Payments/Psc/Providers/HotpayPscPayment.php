<?php


namespace App\Payments\Psc\Providers;


use App\Models\Server;
use App\Models\Service;
use App\Payments\Psc\FormPscPayment;
use App\Payments\Psc\PscPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class HotpayPscPayment implements FormPscPayment
{
    private const API_URL = 'https://psc.hotpay.pl/';
    private const HASH_FORMAT = '%s;%s;%s;%s;%s;%s';
    
    private $secret;
    private $amount;
    private $amountRaw;
    private $description;
    private $control;
    private $status;
    private $pid;
    private $hash;
    private $orderHash;
    
    public static function new(Server $server, Service $service, UuidInterface $orderHash): PscPayment
    {
        $instance = new self();
        
        $instance->orderHash = $orderHash;
        $instance->secret = setting('settings_payments_hotpay_psc_secret');
        $instance->amount = $service->getPscCostRaw();
        $instance->description = Lang::get('main.payments.payment_title', [
            'service' => $service->getName(),
            'server' => $server->getName(),
            'page_title' => setting('general_page_title')
        ]);
        $instance->control = Str::uuid();
        $instance->status = 'CREATED';
        
        return $instance;
    }
    
    public function getFormData(): array
    {
        return [
            'action' => self::API_URL,
            'SEKRET' => $this->secret,
            'KWOTA' => paymentCostToString($this->amount),
            'NAZWA_USLUGI' => $this->description,
            'ADRES_WWW' => route('order', $this->orderHash),
            'ID_ZAMOWIENIA' => $this->control->toString(),
            'EMAIL' => '',
            'DANE_OSOBOWE' => ''
        ];
    }
    
    public static function fromRequest(Request $request): ?PscPayment
    {
        
        if (!$request->has([
            'KWOTA',
            'ID_PLATNOSCI',
            'ID_ZAMOWIENIA',
            'STATUS',
            'SEKRET',
            'HASH'
        ])) {
            return null;
        }
        
        $instance = new self();
        
        $instance->amount = paymentStringCostToInteger($request->get('KWOTA'));
        $instance->pid = $request->get('ID_PLATNOSCI');
        $instance->control = Uuid::fromString($request->get('ID_ZAMOWIENIA'));
        $instance->secret = $request->get('SEKRET');
        $instance->hash = $request->get('HASH');
        $instance->statusRaw = $request->get('STATUS');
        
        switch ($instance->statusRaw) {
            case 'FAILURE':
                $instance->status = 'FAILED';
                break;
            case 'SUCCESS':
                $instance->status = 'SUCCESSFUL';
                break;
            default:
                $instance->status = 'CREATED';
                break;
        }

        return $instance;
    }
    
    public function compare(\App\Models\Payment $payment): bool
    {
        echo
        
        $hash = hash(
            'sha256',
            sprintf(
                self::HASH_FORMAT,
                setting('settings_payments_hotpay_psc_hash'),
                $this->amountRaw,
                $this->pid,
                $this->control,
                $this->getStatus(),
                setting('settings_payments_hotpay_psc_secret')
            )
        );
    
        if (($payment === null) || ($this->getPid() != $payment->getPid())) {
            return false;
        }
        
        if ($this->hash != $hash) {
            return false;
        }
        
        return true;
    }
    
    public function getPid(): ?string
    {
        return $this->pid;
    }
    
    public function getControl(): Uuid
    {
        return $this->control;
    }
    
    public function getAmount(): int
    {
        return $this->amount;
    }
    
    public function getStatus(): ?string
    {
        return $this->status;
    }
}
