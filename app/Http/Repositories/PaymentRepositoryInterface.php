<?php


namespace App\Http\Repositories;


use App\Models\Payment;
use Ramsey\Uuid\Uuid;

interface PaymentRepositoryInterface
{
    public function new(\App\Payments\Payment $payment): ?Payment;
    
    public function getByControl(Uuid $control): ?Payment;
    
    public function update(Payment $paymentModel, \App\Payments\Payment $payment, bool $withPid = false): int;
}
