<?php

namespace FlyingLuscas\PagarMeLaravel;

use PagarMe\Sdk\PagarMe;
use Illuminate\Support\ServiceProvider;

class PagarMeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/pagarme.php', 'pagarme'
        );

        $this->publishes([
            __DIR__.'/../config/pagarme.php' => config_path('pagarme.php')
        ]);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('PagarMe', function ($app) {
            return new PagarMe(
                $app->config->get('pagarme.api_key')
            );
        });
    }
}
