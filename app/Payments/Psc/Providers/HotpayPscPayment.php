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

class HotpayPscPayment implements FormPscPayment
{
    private const API_URL = 'https://platnosc.hotpay.pl/';
    private const HASH_FORMAT = '%s;%s;%s;%s;%s;%s';
    
    private $secret;
    private $amount;
    private $description;
    private $control;
    private $status;
    private $pid;
    private $hash;
    
    public static function new(Server $server, Service $service): PscPayment
    {
        $instance = new self();
        
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
            'ADRES_WWW' => route('api.payments.psc'),
            'ID_ZAMOWIENIA' => $this->control->toString()
        ];
    }
    
    public static function fromRequest(Request $request): ?PscPayment
    {
        $instance = new self();
        
        $instance->amount = paymentCostToString($request->get('KWOTA'));
        $instance->pid = $request->get('ID_PLATNOSCI');
        $instance->control = Uuid::fromString($request->get('ID_ZAMOWIENIA'));
        $instance->secret = $request->get('SEKRET');
        $instance->hash = $request->get('HASH');
        
        switch ($request->get('STATUS')) {
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
        $hash = hash(
            'sha256',
            sprintf(
                self::HASH_FORMAT,
                setting('settings_payments_hotpay_psc_hash'),
                paymentCostToString($payment->getCostRaw()),
                $this->pid,
                $payment->getControl(),
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
