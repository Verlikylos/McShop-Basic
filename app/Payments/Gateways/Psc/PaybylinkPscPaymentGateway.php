<?php


namespace App\Payments\Gateways\Psc;


use App\Models\Order;
use App\Payments\Gateways\WhiteLabelPaymentGateway;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Lang;

class PaybylinkPscPaymentGateway implements WhiteLabelPaymentGateway
{
    private const API_URL = 'https://www.rushpay.pl/api/psc/';
    private const REDIRECT_URL = 'https://paybylink.pl/pay/%s';
    private const API_ALLOWED_ADDRESSES = 'https://paybylink.pl/psc/ips';
    
    public function register(Order $order): array
    {
        $result = [
            'redirectUrl' => null,
            'pid' => null,
            'error' => true
        ];
        
        $data = [
            'userid' => setting('settings_payments_paybylink_userid'),
            'shopid' => setting('settings_payments_paybylink_psc_shopid'),
            'return_ok' => route('order', $order->getHash()->toString()),
            'return_fail' => route('order', $order->getHash()->toString()),
            'url' => route('api.payments.psc'),
            'description' => Lang::get('main.payments.payment_title', [
                'service' => $order->getService()->getName(),
                'server' => $order->getService()->getServer()->getName(),
                'page_title' => setting('general_page_title')
            ]),
            'amount' => paymentCostToString($order->getPayment()->getCostRaw()),
            'control' => $order->getPayment()->getHash()->toString(),
            'hash' => hash(
                'sha256',
                setting('settings_payments_paybylink_userid') .
                setting('settings_payments_paybylink_psc_shoppin') .
                paymentCostToString($order->getPayment()->getCostRaw())
            ),
            'get_pid' => true,
        ];
        
        $response = Http::asForm()->post(self::API_URL, $data);
    
        if (!$response->ok()) {
            return $result;
        }
    
        $response = $response->object();
    
        if (!is_object($response)) {
            return $result;
        }
    
        if (!$response->status) {
            return $result;
        }
    
        if (!isset($response->pid)) {
            return $result;
        }
        
        $result['pid'] = $response->pid;
        $result['redirectUrl'] = sprintf(self::REDIRECT_URL, $response->pid);
        $result['error'] = false;
        
        return $result;
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
    
}
