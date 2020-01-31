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
            'uses' => 'UserProfileController@index'
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
                Route::post('/store', [
                    'as' => 'store',
                    'uses' => 'UsersController@store'
                ]);
                Route::get('/{user}/edit', [
                    'as' => 'edit',
                    'uses' => 'UsersController@edit'
                ]);
                Route::patch('/{user}', [
                    'as' => 'update',
                    'uses' => 'UsersController@update'
                ]);
                Route::get('/{user}/changePassword', [
                    'as' => 'changePassword',
                    'uses' => 'UsersController@changePassword'
                ]);
                Route::get('/{user}/delete', [
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
                Route::get('/create', [
                    'as' => 'create',
                    'uses' => 'ServersController@create'
                ]);
                Route::post('/store', [
                    'as' => 'store',
                    'uses' => 'ServersController@store'
                ]);
                Route::get('/{server}/announcement', [
                    'as' => 'announcement.show',
                    'uses' => 'ServersController@show_announcement'
                ]);
                Route::patch('/{server}/announcement', [
                    'as' => 'announcement.update',
                    'uses' => 'ServersController@update_announcement'
                ]);
                Route::get('/{server}/toggleActive', [
                    'as' => 'active.toggle',
                    'uses' => 'ServersController@toggle_active'
                ]);
                Route::get('/{server}/swap/{up}', [
                    'as' => 'swap',
                    'uses' => 'ServersController@swap'
                ]);
                Route::get('/{server}/edit', [
                    'as' => 'edit',
                    'uses' => 'ServersController@edit'
                ]);
                Route::patch('/{server}', [
                    'as' => 'update',
                    'uses' => 'ServersController@update'
                ]);
                Route::get('/{server}/delete', [
                    'as' => 'delete',
                    'uses' => 'ServersController@delete'
                ]);
            });
    
        Route::prefix('services')
            ->name('services.')
            ->group(function () {
                Route::get('/create', [
                    'as' => 'create',
                    'uses' => 'ServicesController@create'
                ]);
                Route::post('/store', [
                    'as' => 'store',
                    'uses' => 'ServicesController@store'
                ]);
                Route::get('/{service}/toggleActive', [
                    'as' => 'active.toggle',
                    'uses' => 'ServicesController@toggle_active'
                ]);
                Route::get('/{service}/swap/{up}', [
                    'as' => 'swap',
                    'uses' => 'ServicesController@swap'
                ]);
                Route::get('/{service}/edit', [
                    'as' => 'edit',
                    'uses' => 'ServicesController@edit'
                ]);
                Route::patch('/{service}', [
                    'as' => 'update',
                    'uses' => 'ServicesController@update'
                ]);
                Route::get('/{service}/delete', [
                    'as' => 'delete',
                    'uses' => 'ServicesController@delete'
                ]);
                Route::get('/{server?}', [
                    'as' => 'index',
                    'uses' => 'ServicesController@index'
                ]);
            });

        Route::prefix('settings')
            ->name('settings.')
            ->group(function () {
                Route::get('/', [
                    'as' => 'index',
                    'uses' => 'SettingsController@index'
                ]);

                Route::namespace('Settings')
                    ->group(function () {
                        Route::get('/numbers/create', [
                            'as' => 'numbers.create',
                            'uses' => 'SmsNumbersController@create'
                        ]);
                        Route::get('/numbers/{number}/delete', [
                            'as' => 'numbers.delete',
                            'uses' => 'SmsNumbersController@delete'
                        ]);
                        Route::post('/numbers', [
                            'as' => 'numbers.store',
                            'uses' => 'SmsNumbersController@store'
                        ]);
                        Route::get('/numbers/{operator?}', [
                            'as' => 'numbers.index',
                            'uses' => 'SmsNumbersController@index'
                        ]);
                        Route::get('/general', [
                            'as' => 'general.index',
                            'uses' => 'GeneralController@index'
                        ]);
                        Route::patch('/general', [
                            'as' => 'general.update',
                            'uses' => 'GeneralController@update'
                        ]);
                        Route::get('/layout', [
                            'as' => 'layout.index',
                            'uses' => 'LayoutController@index'
                        ]);
                        Route::patch('/layout', [
                            'as' => 'layout.update',
                            'uses' => 'LayoutController@update'
                        ]);
                    });
            });
    });

Route::get('/{server}/service/{service}', [
    'as' => 'service',
    'uses' => 'ServiceController@index'
]);

Route::get('/{server?}', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);
