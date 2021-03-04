<?php


namespace App\Payments\Sms;


class PaybylinkSmsPayment extends MicroSmsSmsPayment
{
    protected $apiUrl = 'https://paybylink.pl/api/v2/index.php?userid=%s&number=%s&code=%s&serviceid=%s';
}
