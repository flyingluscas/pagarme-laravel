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
        $configFile = __DIR__.'/../config/pagarme.php';

        $this->mergeConfigFrom($configFile, 'pagarme');

        $this->publishes([
            $configFile => config_path('pagarme.php'),
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
                $app->config->get('pagarme.keys.api')
            );
        });
    }
}
