<?php


namespace App\Payments\Psc;

use App\Models\Server;
use App\Models\Service;
use App\Payments\Payment;
use Illuminate\Http\Request;

interface PscPayment extends Payment
{
    public static function new(Server $server, Service $service): PscPayment;
    
    public static function fromRequest(Request $request): ?PscPayment;
    
    public function compare(\App\Models\Payment $payment): bool;
}
