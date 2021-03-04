<?php


namespace App\Payments\Gateways;


use App\Models\Order;

interface WhiteLabelPaymentGateway extends PaymentGateway
{
    public function register(Order $order): array;
}
