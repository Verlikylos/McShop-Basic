<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')
    ->name('api.')
    ->group(function () {
       Route::get('/servers/{server}/status', [
           'as' => 'servers.status',
           'uses' => 'ServersController@status'
        ]);
       Route::get('/teamspeak/status', [
           'as' => 'teamspeak.status',
           'uses' => 'TeamspeakController@status'
       ]);
});

Route::post('/api/payment/verify', [
    'as' => 'api.payment.verify',
    'uses' => 'CheckoutController@verify'
]);


