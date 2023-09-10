<?php

namespace App\Providers;

use App\Algorand\Algorand;
use App\Services\AlgorandService;
use Illuminate\Support\ServiceProvider;

class AlgorandServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton(AlgorandService::class, function ($app) {
            return new AlgorandService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
