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
});


