<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Utils\Response\ResponseService;
use App\Services\Utils\Response\ResponseServiceInterface;
use App\Services\Auth\AuthService;
use App\Services\Auth\AuthServiceInterface;
use App\Services\Checkout\CheckoutService;
use App\Services\Checkout\CheckoutServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ResponseServiceInterface::class, ResponseService::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(CheckoutServiceInterface::class, CheckoutService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
