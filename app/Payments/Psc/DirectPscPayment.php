<?php


namespace App\Payments\Psc;


interface DirectPscPayment extends PscPayment
{
    public function register(): bool;
    
    public function getRedirectUrl(): ?string;
}
