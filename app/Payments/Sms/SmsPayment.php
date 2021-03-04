<?php


namespace App\Payments\Sms;


interface SmsPayment
{
    public function setCode(string $code): void;
    
    public function setNumber(string $number): void;
    
    public function isCodeValid(): bool;
    
    public function getErrorMessage(): string;
}
