<?php


namespace App\Facades;


use App\Models\Server;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;


/**
 * @method static \App\Payments\Psc\PscPayment createPscPayment(Server $server, Service $service)
 * @method static null|\App\Payments\Psc\PscPayment getPscPayment(Request $request)
 */
class PaymentManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'paymentmanager';
    }
}
