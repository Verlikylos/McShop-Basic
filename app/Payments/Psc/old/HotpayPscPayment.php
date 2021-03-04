<?php


namespace App\Payments\Psc;


use App\Models\Server;
use App\Models\Service;
use Illuminate\Support\Facades\Lang;

class HotpayPscPayment implements ClassicPscPayment
{
    public function isWhiteLabel(): bool
    {
        return false;
    }
    
    public function readyFormData(Service $service, Server $server): array
    {
        return [
            'action' => 'https://psc.hotpay.pl/',
            'SEKRET' => setting('settings_payments_hotpay_psc_secret'),
            'KWOTA' => $service->getPscCost(),
            'NAZWA_USLUGI' => Lang::get('main.payments.payment_title', [
                'service' => $service->getName(),
                'server' => $server->getName(),
                'page_title' => setting('general_page_title')
            ]),
            'ADRES_WWW' => '',
            'ID_ZAMOWIENIA' => '',
        ];
    }
    
    public function verifyResponse(): bool
    {
        $data = request()->only([
            'KWOTA',
            'ID_PLATNOSCI',
            'ID_ZAMOWIENIA',
            'STATUS',
            'SEKRET',
            'HASH'
        ]);
        
        if (
            !isset($data['KWOTA']) ||
            !isset($data['ID_PLATNOSCI']) ||
            !isset($data['ID_ZAMOWIENIA']) ||
            !isset($data['STATUS']) ||
            !isset($data['SEKRET']) ||
            !isset($data['HASH'])
        ) {
            return false;
        }
        
        $hash = sprintf('%s;%s;%s;%s;%s;%s',
            setting('settings_payments_hotpay_psc_notify_hash'),
            $data['KWOTA'],
            $data['ID_PLATNOSCI'],
            $data['ID_ZAMOWIENIA'],
            $data['STATUS'],
            $data['SEKRET']
        );
        
        if ($hash != $data['HASH']) {
            return false;
        }
        
        if ($data['STATUS'] == 'SUCCESS') {
            return true;
        }
        
        return false;
    }
    
    public function getErrorMessage(): ?string
    {
        // TODO: Implement getErrorMessage() method.
    }
}
