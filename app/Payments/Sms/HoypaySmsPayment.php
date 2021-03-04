<?php


namespace App\Payments\Sms;


class HoypaySmsPayment
{
    private $code;
    private $number;
    private $errorMessage;
    private $isValid;
    protected $apiUrl = 'http://microsms.pl/api/v2/index.php?userid=%s&number=%s&code=%s&serviceid=%s';
}
