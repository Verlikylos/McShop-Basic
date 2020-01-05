<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ServersController extends Controller
{
    public function index()
    {
        return View::make('admin.servers.index');
    }
}
