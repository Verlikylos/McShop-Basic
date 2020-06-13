<?php


namespace App\Payments\Psc;


use App\Models\Server;
use App\Models\Service;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

interface ClassicPscPayment extends PscPayment
{
    public function readyFormData(Service $service, Server $server, Uuid $pid): array;
    
    public function verifyRequest(Request $request): bool;
}
