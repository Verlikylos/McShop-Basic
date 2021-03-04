<?php


namespace App\Enums;


class PaymentType extends Enum
{
    public const SMS = 'SMS';
    public const PSC = 'PSC';
    public const TRANSFER = 'TRANSFER';
    public const PAYPAL = 'PAYPAL';
}
