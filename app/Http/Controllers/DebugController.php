<?php

namespace App\Http\Controllers;

use App\Facades\PaymentManager;
use App\Models\Server;
use App\Models\Service;
use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function index()
    {
        $service = Service::where('id', 5)->first();
        $service->redeem('Verlikylos');
        
    }
}
