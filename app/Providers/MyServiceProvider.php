<?php

namespace App\Providers;

use App\Services\HelperService;
use Illuminate\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register the HelperService in the service container
        // $this->app->bind('helper',function(){
        //     return new \App\Services\HelperService();
        // });

        // Register the HelperService by singleton
        $this->app->singleton(HelperService::class, function () {
            return new HelperService();
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
