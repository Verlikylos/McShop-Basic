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
        $test = [
            "--------------------------174d6f0ce4297e2f Content-Disposition:_attachment;_name"=>  '"KWOTA" 25.00 --------------------------174d6f0ce4297e2f Content-Disposition: attachment; name="ID_PLATNOSCI" 9564107a3d18431fb32b378b893ae7fe --------------------------174d6f0ce4297e2f Content-Disposition: attachment; name="ID_ZAMOWIENIA" 8333032f-c806-4154-b6fb-32366ab75a99 --------------------------174d6f0ce4297e2f Content-Disposition: attachment; name="STATUS" SUCCESS --------------------------174d6f0ce4297e2f Content-Disposition: attachment; name="SEKRET" WnFudHBQb0FOQzBRVnp6L2hEbzVEQVpiMy9JWDdmOWE5SktpenlWVjVmRT0, --------------------------174d6f0ce4297e2f Content-Disposition: attachment; name="HASH" 54fecaa9860ff199fe07070ebb384bb155b21b88e870bfc24d04af2f63850abe --------------------------174d6f0ce4297e2f--'
        ];
        dd($test);
    }
}
