<?php


namespace App\Payments\Gateways\Psc;


use App\Models\Order;
use App\Payments\Gateways\FormBasedPaymentGateway;
use Illuminate\Support\Facades\Lang;

class HotpayPscPaymentGateway implements FormBasedPaymentGateway
{
    private const API_URL = 'https://psc.hotpay.pl/';
    private const HASH_FORMAT = '%s;%s;%s;%s;%s;%s';
    
    public function getFormData(Order $order): array
    {
        return [
            'action' => self::API_URL,
            'SEKRET' => setting('settings_payments_hotpay_psc_secret'),
            'KWOTA' => paymentCostToString($order->getPayment()->getCostRaw()),
            'NAZWA_USLUGI' => Lang::get('main.payments.payment_title', [
                'service' => $order->getService()->getName(),
                'server' => $order->getService()->getServer()->getName(),
                'page_title' => setting('general_page_title')
            ]),
            'ADRES_WWW' => route('order', $order->getHash()),
            'ID_ZAMOWIENIA' => $order->getPayment()->getHash(),
            'EMAIL' => '',
            'DANE_OSOBOWE' => ''
        ];
    }
}
