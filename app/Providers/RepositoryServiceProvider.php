<?php

namespace App\Providers;

use App\Http\Repositories\LogRepositoryInterface;
use App\Http\Repositories\OrderRepositoryInterface;
use App\Http\Repositories\PaymentRepositoryInterface;
use App\Http\Repositories\ServerRepositoryInterface;
use App\Http\Repositories\ServiceRepositoryInterface;
use App\Http\Repositories\SmsNumberRepositoryInterface;
use App\Http\Repositories\SQL\LogRepository;
use App\Http\Repositories\SQL\OrderRepository;
use App\Http\Repositories\SQL\PaymentRepository;
use App\Http\Repositories\UserRepositoryInterface;
use App\Http\Repositories\VoucherRepositoryInterface;
use App\Http\Repositories\PageRepositoryInterface;
use App\Http\Repositories\SQL\ServerRepository;
use App\Http\Repositories\SQL\ServiceRepository;
use App\Http\Repositories\SQL\SmsNumberRepository;
use App\Http\Repositories\SQL\PageRepository;
use App\Http\Repositories\SQL\UserRepository;
use App\Http\Repositories\SQL\VoucherRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ServerRepositoryInterface::class, ServerRepository::class);
        $this->app->bind(SmsNumberRepositoryInterface::class, SmsNumberRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(VoucherRepositoryInterface::class, VoucherRepository::class);
        $this->app->bind(PageRepositoryInterface::class, PageRepository::class);
        $this->app->bind(LogRepositoryInterface::class, LogRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        
    }
}
