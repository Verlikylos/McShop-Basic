<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payments\SmsPaymentRequest;
use App\Jobs\ExecuteServiceCommands;
use App\Models\Server;
use App\Models\Service;
use App\Payments\Sms\SmsPayment;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;

class SmsPaymentController extends Controller
{
    
    public function checkout(SmsPaymentRequest $request, Server $server, Service $service, SmsPayment $payment)
    {
        $payment->setCode($request->get('smsCode'));
        $payment->setNumber($service->getSmsNumber()->getNumber());
        
        if (method_exists($payment, 'setDescription')) {
            $payment->setDescription(Lang::get('main.payments.payment_title', [
                'service' => $service->getName(),
                'server' => $server->getName(),
                'page_title' => setting('general_page_title')
            ]));
        }
        
        if (!$payment->isCodeValid()) {
            return Redirect::route('service', ['server' => $server->getSlug(), 'service' => $service])
                ->with('shopSessionMessage',[
                    'type' => 'danger',
                    'content' => $payment->getErrorMessage()
                ]);
        }
        
        //TODO INSERT TO DB purchases
        
        ExecuteServiceCommands::dispatch($service, $request->get('playerName'));
    
        return Redirect::route('home', ['server' => $server->getSlug()])
        ->with('shopSessionMessage',[
            'type' => 'success',
            'content' => Lang::get('main.payments.completed', [
                'service' => $service->getName()
            ])
        ]);
    }
}
