<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ServiceController extends Controller
{
    public function index(Server $server, Service $service)
    {
        return View::make('service', ['server' => $server, 'service' => $service]);
    }
}
