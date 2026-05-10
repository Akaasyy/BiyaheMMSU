<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in local or when using a tunnel to avoid Mixed Content errors
        if (config('app.env') === 'local' || config('app.env') === 'staging') {
            URL::forceScheme('https');
        }
    }
}