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

Route::name('api.payments.')
    ->prefix('payments')
    ->group(function () {
        Route::post('/psc', [
            'as' => 'psc',
            'uses' => 'Payments\\PscPaymentController@verify'
        ]);
});

Route::post('/transfer/notify/hotpay', [
    'as' => 'pscas',
    'uses' => 'Payments\\PscPaymentController@verify'
]);


