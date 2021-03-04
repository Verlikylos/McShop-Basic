<?php


namespace App\Http\Repositories;


use App\Models\Payment;
use Ramsey\Uuid\Uuid;

interface PaymentRepositoryInterface
{
    public function new($type, $provider, $cost): Payment;
    
    public function setPid(Payment $payment, string $pid): bool;
    
    public function save(Payment $payment): bool;
    
    public function getByControl(Uuid $control): ?Payment;
    
    public function update(Payment $paymentModel, \App\Payments\Payment $payment, bool $withPid = false): int;
}
