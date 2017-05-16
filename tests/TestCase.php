<?php

namespace FlyingLuscas\PagarMeLaravel;

use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
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
