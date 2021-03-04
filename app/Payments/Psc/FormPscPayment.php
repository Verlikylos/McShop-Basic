<?php


namespace App\Payments\Psc;


interface FormPscPayment extends PscPayment
{
    public function getFormData(): array;
}
