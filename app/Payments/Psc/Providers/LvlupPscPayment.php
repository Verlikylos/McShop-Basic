<?php


namespace App\Payments\Psc\Providers;


use App\Models\Server;
use App\Models\Service;
use App\Payments\Psc\DirectPscPayment;
use App\Payments\Psc\PscPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class LvlupPscPayment implements DirectPscPayment
{
    private const API_URL = 'https://sandbox-api.lvlup.pro/v4/%s';
    
    private $pid;
    private $amount;
    private $status;
    private $control;
    private $redirectUrl;
    private $orderHash;
    
    public static function new(Server $server, Service $service, UuidInterface $orderHash): PscPayment
    {
        $instance = new self();
        
        $instance->orderHash = $orderHash;
        $instance->amount = paymentCostToString($service->getPscCostRaw());
        $instance->status = 'CREATED';
        $instance->control = Str::uuid();
        
        return $instance;
    }
    
    public static function fromRequest(Request $request): ?PscPayment
    {
        $instance = new self();
        $instance->pid = $request->get('id');
        
        if ($request->get('status') != 'CONFIRMED') {
            $instance->status = 'FAILED';
        } else {
            $instance->status = 'SUCCESSFUL';
        }
        
        return $instance;
    }
    
    public function register(): bool
    {
        if ($this->pid !== null) {
            return false;
        }
    
        $data = [
            'amount' => $this->amount,
            'redirectUrl' => route('order', $this->orderHash),
            'webhookUrl' => route('api.payments.psc')
        ];
    
        $response = Http::withToken(setting('settings_payments_lvlup_apiKey'), 'Bearer')->post(sprintf(self::API_URL, 'wallet/up'), $data);
        
        if (!$response->ok()) {
            return false;
        }
    
        $response = $response->object();
    
        if (!is_object($response)) {
            return false;
        }
    
        if (!isset($response->id)) {
            return false;
        }
    
        $this->pid = $response->id;
        $this->redirectUrl = $response->url;
    
        return true;
    }
    
    public function getRedirectUrl(): ?string
    {
        return $this->redirectUrl;
    }
    
    public function compare(\App\Models\Payment $payment): bool
    {
        if ($this->pid != $payment->getPid()) {
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
