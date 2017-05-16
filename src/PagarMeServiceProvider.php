<?php

namespace FlyingLuscas\PagarMeLaravel;

use Illuminate\Support\ServiceProvider;

class PagarMeServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/pagarme.php', 'pagarme'
        );
    }
}
