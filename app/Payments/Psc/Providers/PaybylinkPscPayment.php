<?php


namespace App\Payments\Psc\Providers;


use App\Models\Payment;
use App\Models\Server;
use App\Models\Service;
use App\Payments\Psc\DirectPscPayment;
use App\Payments\Psc\PscPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class PaybylinkPscPayment implements DirectPscPayment
{
    private const API_URL = 'https://www.rushpay.pl/api/psc/';
    private const REDIRECT_URL = 'https://paybylink.pl/pay/%s';
    private const API_ALLOWED_ADDRESSES = 'https://paybylink.pl/psc/ips';
    
    private $userId;
    private $shopId;
    private $amount;
    private $control;
    private $hash;
    private $description;
    private $status;
    private $pid;
    
    public static function new(Server $server, Service $service): PscPayment
    {
        $instance = new self();
        
        $instance->userId = setting('settings_payments_paybylink_psc_userid');
        $instance->shopId = setting('settings_payments_paybylink_psc_shopid');
        $instance->description = Lang::get('main.payments.payment_title', [
            'service' => $service->getName(),
            'server' => $server->getName(),
            'page_title' => setting('general_page_title')
        ]);
        $instance->amount = $service->getPscCostRaw();
        $instance->control = Str::uuid();
        $instance->hash = hash('sha256', setting('settings_payments_paybylink_psc_userid') . setting('settings_payments_paybylink_psc_shoppin') . paymentCostToString($service->getPscCostRaw()));
        $instance->status = 'CREATED';
        
        return $instance;
    }
    
    public static function fromRequest(Request $request): ?PscPayment
    {
        $allowedIps = self::getAllowedIps();
    
        if ($allowedIps === null) {
            return null;
        }
    
        $clientIp = $request->ip();
    
        if ($request->header('CF-Connecting-IP') !== null) {
            $clientIp = $request->header('CF-Connecting-IP');
        }
    
        if ($clientIp === null) {
            return null;
        }
    
//        if (!in_array($clientIp, $allowedIps, true)) {
//            return null;
//        }
        
        $instance = new self();
        $instance->userId = $request->get('userid');
        $instance->shopId = $request->get('shopid');
        $instance->amount = paymentStringCostToInteger($request->get('amount'));
        $instance->control = Uuid::fromString($request->get('control'));
        $instance->hash = $request->get('hashsha256');
        $instance->description = $request->get('description');
        $instance->pid = $request->get('pid');
        $instance->status = Str::upper($request->get('status')) == 'TRUE' ? 'SUCCESSFUL' : 'FAILED';
    
        return $instance;
    }
    
    public function register(): bool
    {
        if ($this->pid !== null) {
            return false;
        }
    
        $data = [
            'userid' => $this->userId,
            'shopid' => $this->shopId,
            'return_ok' => 'https://www.rushpay.pl/psc/?status=ok',
            'return_fail' => 'https://www.rushpay.pl/psc/?status=fail',
            'url' => 'https://www.rushpay.pl/psc/?checkPayment',
            'description' => $this->description,
            'amount' => paymentCostToString($this->amount),
            'control' => $this->control->toString(),
            'hash' => $this->hash,
            'get_pid' => true,
        ];
    
        $response = Http::asForm()->post(self::API_URL, $data);
    
        if (!$response->ok()) {
            return false;
        }
    
        $response = $response->object();
    
        if (!is_object($response)) {
            return false;
        }
    
        if (!$response->status) {
            return false;
        }
    
        if (!isset($response->pid)) {
            return false;
        }
        
        $this->pid = $response->pid;
        
        return true;
    }
    
    public function getRedirectUrl(): ?string
    {
        if ($this->pid === null) {
            return null;
        }
        
        return sprintf(self::REDIRECT_URL, $this->pid);
    }

    
    public function compare(Payment $payment): bool
    {
        return $this->userId == setting('settings_payments_paybylink_psc_userid') &&
            $this->shopId == setting('settings_payments_paybylink_psc_shopid') &&
            $this->amount == $payment->getCostRaw() &&
            $this->hash == hash(
                'sha256',
                setting('settings_payments_paybylink_psc_userid') .
                    setting('settings_payments_paybylink_psc_shoppin') .
                    paymentCostToString($payment->getOrder()->getService()->getPscCostRaw())
            ) &&
            $this->pid == $payment->getPid();
    }
    
    private static function getAllowedIps(): ?array
    {
        $response = Http::get(self::API_ALLOWED_ADDRESSES);
        
        if (!$response->ok()) {
            return null;
        }
        
        $response = $response->body();
        
        return explode(';', $response);
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
