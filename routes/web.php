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

Route::get('/debug', [
    'as' => 'debug.index',
    'uses' => 'DebugController@index'
]);

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
    
        Route::prefix('vouchers')
            ->name('vouchers.')
            ->group(function () {
                Route::get('/', [
                    'as' => 'index',
                    'uses' => 'VouchersController@index'
                ]);
                Route::get('/create', [
                    'as' => 'create',
                    'uses' => 'VouchersController@create'
                ]);
                Route::post('/store', [
                    'as' => 'store',
                    'uses' => 'VouchersController@store'
                ]);
                Route::get('/{voucher}/delete', [
                    'as' => 'delete',
                    'uses' => 'VouchersController@delete'
                ]);
            });
    
        Route::prefix('pages')
            ->name('pages.')
            ->group(function () {
                Route::get('/', [
                    'as' => 'index',
                    'uses' => 'PagesController@index'
                ]);
                Route::get('/create', [
                    'as' => 'create',
                    'uses' => 'PagesController@create'
                ]);
                Route::post('/store', [
                    'as' => 'store',
                    'uses' => 'PagesController@store'
                ]);
                Route::get('/{page}/toggleActive', [
                    'as' => 'active.toggle',
                    'uses' => 'PagesController@toggle_active'
                ]);
                Route::get('/{page}/swap/{up}', [
                    'as' => 'swap',
                    'uses' => 'PagesController@swap'
                ]);
                Route::get('/{page}/edit', [
                    'as' => 'edit',
                    'uses' => 'PagesController@edit'
                ]);
                Route::patch('/{page}', [
                    'as' => 'update',
                    'uses' => 'PagesController@update'
                ]);
                Route::get('/{page}/delete', [
                    'as' => 'delete',
                    'uses' => 'PagesController@delete'
                ]);
            });
    
        Route::prefix('logs')
            ->name('logs.')
            ->group(function () {
                Route::get('/acp', [
                    'as' => 'acp',
                    'uses' => 'LogsController@acp'
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
                        Route::get('/numbers', [
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
    
                        Route::prefix('payments')
                            ->name('payments.')
                            ->namespace('Payments')
                            ->group(function () {
                                Route::get('/', [
                                    'as' => 'index',
                                    'uses' => 'PaymentsController@index'
                                ]);
                                Route::patch('/', [
                                    'as' => 'update',
                                    'uses' => 'PaymentsController@update'
                                ]);
    
                                Route::get('/lvlup', [
                                    'as' => 'lvlup.index',
                                    'uses' => 'LvlupController@index'
                                ]);
                                Route::patch('/lvlup', [
                                    'as' => 'lvlup.update',
                                    'uses' => 'LvlupController@update'
                                ]);
    
                                Route::get('/microsms', [
                                    'as' => 'microsms.index',
                                    'uses' => 'MicroSmsController@index'
                                ]);
                                Route::patch('/microsms', [
                                    'as' => 'microsms.update',
                                    'uses' => 'MicroSmsController@update'
                                ]);
    
                                Route::get('/paybylink', [
                                    'as' => 'paybylink.index',
                                    'uses' => 'PaybylinkController@index'
                                ]);
                                Route::patch('/paybylink', [
                                    'as' => 'paybylink.update',
                                    'uses' => 'PaybylinkController@update'
                                ]);
    
                                Route::get('/hotpay', [
                                    'as' => 'hotpay.index',
                                    'uses' => 'HotpayController@index'
                                ]);
                                Route::patch('/hotpay', [
                                    'as' => 'hotpay.update',
                                    'uses' => 'HotpayController@update'
                                ]);
                            });
                        
                        Route::get('/voucher', [
                            'as' => 'voucher.index',
                            'uses' => 'VoucherController@index'
                        ]);
                        Route::patch('/voucher', [
                            'as' => 'voucher.update',
                            'uses' => 'VoucherController@update'
                        ]);
                        Route::get('/layout', [
                            'as' => 'layout.index',
                            'uses' => 'LayoutController@index'
                        ]);
                        Route::patch('/layout', [
                            'as' => 'layout.update',
                            'uses' => 'LayoutController@update'
                        ]);
                        Route::get('/widget', [
                            'as' => 'widget.index',
                            'uses' => 'WidgetController@index'
                        ]);
    
                        Route::prefix('widget')
                            ->name('widget.')
                            ->namespace('Widgets')
                            ->group(function () {
                                Route::get('/teamspeak', [
                                    'as' => 'teamspeak.index',
                                    'uses' => 'TeamspeakController@index'
                                ]);
                                Route::patch('/teamspeak', [
                                    'as' => 'teamspeak.update',
                                    'uses' => 'TeamspeakController@update'
                                ]);
                                Route::get('/teamspeak/toggleActive', [
                                    'as' => 'teamspeak.toggle_active',
                                    'uses' => 'TeamspeakController@toggle_active'
                                ]);
                                
                                Route::get('/discord', [
                                    'as' => 'discord.index',
                                    'uses' => 'DiscordController@index'
                                ]);
                                Route::patch('/discord', [
                                    'as' => 'discord.update',
                                    'uses' => 'DiscordController@update'
                                ]);
                                Route::get('/discord/toggleActive', [
                                    'as' => 'discord.toggle_active',
                                    'uses' => 'DiscordController@toggle_active'
                                ]);
                            });
                    });
            });
    });

Route::get('/page/{page}', [
    'as' => 'page',
    'uses' => 'PageController@index'
]);

Route::get('/{server}/service/{service}', [
    'as' => 'service',
    'uses' => 'ServiceController@index'
]);

Route::get('/{server?}', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

Route::post('/{server}/service/{service}/checkout/sms', [
    'as' => 'service.checkout.sms',
    'uses' => 'Payments\\SmsPaymentController@checkout'
]);

Route::post('/{server}/service/{service}/checkout/psc', [
    'as' => 'service.checkout.psc',
    'uses' => 'Payments\\PscPaymentController@checkout'
]);
