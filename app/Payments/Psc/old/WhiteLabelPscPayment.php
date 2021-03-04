<?php


namespace App\Payments\Psc;


use App\Models\Server;
use App\Models\Service;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

interface WhiteLabelPscPayment extends PscPayment
{
    public function register(Service $service, Server $server, Uuid $control): ?array;
    
    public function verifyRequest(Request $request): bool;
}
