<?php

namespace FlyingLuscas\PagarMeLaravel;

use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [PagarMeServiceProvider::class];
    }
}
