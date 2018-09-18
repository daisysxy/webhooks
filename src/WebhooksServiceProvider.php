<?php

namespace Sxy\Webhooks;

use Illuminate\Support\ServiceProvider;

class WebhooksServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/web.php');

        $this->publishes([
            __DIR__.'web_hooks.php' => config_path('web_hooks.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton('webhooks', function () {
            return new Webhooks;
        });
    }
}