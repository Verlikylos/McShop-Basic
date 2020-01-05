<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

Route::get('/service', [
    'as' => 'service',
    'uses' => 'ServiceController@index'
]);

Route::permanentRedirect('/admin', '/auth');

Route::get('/auth', [
    'as' => 'auth.index',
    'uses' => 'AuthController@index'
]);

Route::post('/auth/login', [
    'as' => 'auth.login',
    'uses' => 'AuthController@login'
]);

Route::middleware('auth')
    ->namespace('Admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/profile', [
            'as' => 'profile',
            'uses' => 'ProfileController@index'
        ]);

        Route::get('/dashboard', [
            'as' => 'dashboard',
            'uses' => 'DashboardController@index'
        ]);

        Route::prefix('users')
            ->name('users.')
            ->group(function () {
                Route::get('/', [
                    'as' => 'index',
                    'uses' => 'UsersController@index'
                ]);
                Route::get('/create', [
                    'as' => 'create',
                    'uses' => 'UsersController@create'
                ]);
                Route::post('/new', [
                    'as' => 'store',
                    'uses' => 'UsersController@store'
                ]);
                Route::get('/{id}/edit', [
                    'as' => 'edit',
                    'uses' => 'UsersController@edit'
                ]);
                Route::patch('/{id}', [
                    'as' => 'update',
                    'uses' => 'UsersController@update'
                ]);
                Route::get('/{id}/changePassword', [
                    'as' => 'changePassword',
                    'uses' => 'UsersController@changePassword'
                ]);
                Route::get('/{id}/delete', [
                    'as' => 'delete',
                    'uses' => 'UsersController@delete'
                ]);
            });

        Route::prefix('servers')
            ->name('servers.')
            ->group(function () {
                Route::get('/', [
                    'as' => 'index',
                    'uses' => 'ServersController@index'
                ]);
            });
    });
