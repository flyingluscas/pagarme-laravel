<?php

namespace FlyingLuscas\PagarMeLaravel;

use Orchestra\Testbench\TestCase;

abstract class IntegrationTestCase extends TestCase
{
    /**
     * Service providers to be loaded.
     *
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [PagarMeServiceProvider::class];
    }
}
