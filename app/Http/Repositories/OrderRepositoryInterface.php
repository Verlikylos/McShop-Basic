<?php


namespace App\Http\Repositories;


use App\Models\Order;
use App\Models\Payment;
use App\Models\Service;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

interface OrderRepositoryInterface
{
    public function getByHash(UuidInterface $hash, $withService = false, $withPayment = false): ?Order;
    
    public function new(Service $service, string $customer): Order;
    
    public function associatePayment(Order $order, Payment $payment): bool;
    
    public function save(Order $order): bool;
    
    public function update(Order $order, array $data): int;
}
