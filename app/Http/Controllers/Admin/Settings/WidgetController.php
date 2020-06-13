<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class WidgetController extends Controller
{
    public function index()
    {
       return View::make('admin.settings.widget');
    }
}
