<?php


namespace App\Payments;


use App\Models\Server;
use App\Models\Service;
use App\Payments\Psc\Providers\PaybylinkPscPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class PaymentManager
{
    
    public function createSmsPayment() {
        //
    }
    
    public function createPscPayment(Server $server, Service $service)
    {
        $className = config('mcshop.payment_providers.psc.' . setting('settings_payments_psc_operator') . '.class');
        
        return $className::new($server, $service);
    }
    
    public function getPscPayment(Request $request)
    {
        $className = config('mcshop.payment_providers.psc.' . setting('settings_payments_psc_operator') . '.class');
    
        return $className::fromRequest($request);
    }
}
