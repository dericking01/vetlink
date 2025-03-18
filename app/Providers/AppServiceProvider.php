<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SprintSmsService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SprintSmsService::class, function ($app) {
            return new SprintSmsService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
