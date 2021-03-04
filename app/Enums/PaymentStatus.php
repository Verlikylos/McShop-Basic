<?php


namespace App\Enums;


class PaymentStatus extends Enum
{
    public const CREATED = 'CREATED';
    public const SUCCESSFUL = 'SUCCESSFUL';
    public const FAILED = 'FAILED';
    public const CANCELED = 'CANCELED';
}
