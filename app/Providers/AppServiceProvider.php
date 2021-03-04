<?php

namespace App\Providers;

use App\Payments\Psc\PscPayment;
use App\Payments\Sms\SmsPayment;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\Parsedown::class);
        
        if (Schema::hasTable('settings')) {
            $this->app->bind(SmsPayment::class, config('mcshop.payment_providers.sms.' . setting('settings_payments_sms_operator') . '.class'));
            $this->app->bind(PscPayment::class, config('mcshop.payment_providers.psc.' . setting('settings_payments_psc_operator') . '.class'));
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('pl');
    }
}
