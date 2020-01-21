<?php

namespace App\Providers;

use App\Http\Repositories\Interfaces\ServerRepositoryInterface;
use App\Http\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Http\Repositories\Interfaces\SmsNumberRepositoryInterface;
use App\Http\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Repositories\ServerRepository;
use App\Http\Repositories\ServiceRepository;
use App\Http\Repositories\SmsNumberRepository;
use App\Http\Repositories\UserRepository;
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
    }
}
