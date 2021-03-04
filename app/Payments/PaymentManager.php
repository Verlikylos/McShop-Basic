<?php


namespace App\Payments;


use App\Models\Server;
use App\Models\Service;
use App\Payments\Gateways\PaymentGateway;
use App\Payments\Psc\Providers\PaybylinkPscPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Ramsey\Uuid\UuidInterface;

class PaymentManager
{
    public function getPaymentGateway(string $paymentType): ?PaymentGateway
    {
        $paymentOperator = setting('settings_payments_' . strtolower($paymentType) . '_operator');
        
        if ($paymentOperator === null) {
            return null;
        }
        
        $className = config('mcshop.payment_gateways.' . strtolower($paymentType) . '.' . $paymentOperator);
        
        return new $className;
    }
}
