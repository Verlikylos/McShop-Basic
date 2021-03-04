<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Server;
use Illuminate\Support\Facades\Response;

class ServersController extends Controller
{
    public function status(Server $server)
    {
        return Response::json($server->getStatus());
    }
}
