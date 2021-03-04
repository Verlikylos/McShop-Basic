<?php


namespace App\Payments\Psc;


use App\Models\Payment;
use App\Models\Server;
use App\Models\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;
use Ramsey\Uuid\Uuid;

class PaybylinkPscPayment implements WhiteLabelPscPayment
{
    private $apiUrl = 'https://www.rushpay.pl/api/psc/';
    private $apiPayUrl = 'https://paybylink.pl/pay/%s';
    private $apiIps = 'https://paybylink.pl/psc/ips';
    private $status;
    private $test;
    private $userid;
    private $shopid;
    private $pid;
    private $mtid;
    private $amount;
    private $control;
    private $errorMessage;
    private $verified = false;
    
    public function isWhiteLabel(): bool
    {
        return true;
    }
    
    public function register(Service $service, Server $server, Uuid $control): ?array
    {
        $data = [
            'userid' => setting('settings_payments_paybylink_psc_userid'),
            'shopid' => setting('settings_payments_paybylink_psc_shopid'),
            'return_ok' => 'https://www.rushpay.pl/psc/?status=ok',
            'return_fail' => 'https://www.rushpay.pl/psc/?status=fail',
            'url' => 'https://www.rushpay.pl/psc/?checkPayment',
            'description' => Lang::get('main.payments.payment_title', [
                'service' => $service->getName(),
                'server' => $server->getName(),
                'page_title' => setting('general_page_title')
            ]),
            'amount' => $service->getPscCostString(),
            'control' => $control->toString(),
            'hash' => hash('sha256', setting('settings_payments_paybylink_psc_userid') . setting('settings_payments_paybylink_psc_shoppin') . $service->getPscCostString()),
            'get_pid' => true,
        ];
        
        $response = Http::asForm()->post($this->apiUrl, $data);
        
        if (!$response->ok()) {
            $this->errorMessage = Lang::get('main.payments.general_error');
            
            return null;
        }
    
        $response = $response->object();
    
        if (!is_object($response)) {
            $this->errorMessage = Lang::get('main.payments.general_error');
            
            return null;
        }
    
        if (!$response->status) {
            $this->errorMessage = Lang::get('main.payments.general_error');
            
            return null;
        }
        
        if (!isset($response->pid)) {
            $this->errorMessage = Lang::get('main.payments.general_error');
    
            return null;
        }
        
        return ['url' => sprintf($this->apiPayUrl, $response->pid), 'pid' => $response->pid];
    }
    
    public function verifyRequest(Request $request): bool
    {
        $allowedIps = $this->getAllowedIps();
        
        if ($allowedIps === null) {
            return false;
        }
        
        $clientIp = $request->ip();
    
        if ($request->header('CF-Connecting-IP') !== null) {
            $clientIp = $request->header('CF-Connecting-IP');
        }
        
        if ($clientIp === null) {
            return false;
        }
        
        if (!in_array($clientIp, $allowedIps, true)) {
            return false;
        }
        
        $data = $request->only([
            'status',
            'userid',
            'shopid',
            'pid',
            'amount',
            'control',
            'hashsha256',
        ]);
        
        try {
            $payment = Payment::where('pid', $data['pid'])->where('control', $data['control'])->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return false;
        }
        
        if (
            $data['userid'] != setting('settings_payments_paybylink_psc_userid') ||
            $data['shopid'] != setting('settings_payments_paybylink_psc_shopid') ||
            $data['amount'] != $payment->getCostString() ||
            $data['hashsha256'] != hash('sha256', setting('settings_payments_paybylink_psc_userid') . setting('settings_payments_paybylink_psc_shoppin') . $payment->getCostString())
        ) {
            return false;
        }
        
        return true;
    }
    
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }
    
    private function getAllowedIps(): ?array
    {
        $response = Http::get($this->apiIps);
    
        if (!$response->ok()) {
            return null;
        }
    
        $response = $response->body();
        
        return explode(';', $response);
    }
}
