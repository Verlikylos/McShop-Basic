<?php


namespace App\Enums;


class OrderStatus extends Enum
{
    public const CREATED = 'CREATED';
    public const PAID = 'PAID';
    public const CANCELED = 'CANCELED';
    public const COMPLETED = 'COMPLETED';
    public const FAILED = 'FAILED';
}
