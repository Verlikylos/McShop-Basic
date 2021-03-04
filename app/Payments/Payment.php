<?php


namespace App\Payments;


use Ramsey\Uuid\Uuid;

interface Payment
{
    public function getPid(): ?string;
    
    public function getControl(): Uuid;
    
    public function getAmount(): int;
    
    public function getStatus(): ?string;
}
