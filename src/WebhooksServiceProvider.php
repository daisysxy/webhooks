<?php

namespace Sxy\Webhooks;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/web.php');
    }

    public function register()
    {
        $this->app->singleton('webhooks', function () {
            return new Webhooks;
        });
    }
}