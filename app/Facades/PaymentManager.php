<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;


/**
 * @method static \App\Payments\Gateways\PaymentGateway getPaymentGateway(string $paymentType)
 */
class PaymentManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'paymentmanager';
    }
}
