<?php


namespace App\Payments\Gateways;


use App\Models\Order;

interface FormBasedPaymentGateway extends PaymentGateway
{
    public function getFormData(Order $order): array;
}
