<?php


namespace App\Http\Repositories;


use App\Models\Order;
use App\Models\Payment;
use App\Models\Service;

interface OrderRepositoryInterface
{
    public function new(Service $service, string $customer, Payment $payment = null): Order;
    
    public function update(Order $order, array $data): int;
}
