<?php

namespace App\Providers;

use App\Helpers\Helpers;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('Helpers', function ($app) {
            return new Helpers;
        });
    }

    public function boot(): void
    {
        //
    }
}
