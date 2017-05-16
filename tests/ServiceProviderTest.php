<?php

namespace FlyingLuscas\PagarMeLaravel;

class ServiceProviderTest extends TestCase
{
    public function testIfServiceProviderIsBeingLoaded()
    {
        $pagarme = PagarMeServiceProvider::class;
        $providers = $this->app->getLoadedProviders();

        $this->assertArrayHasKey($pagarme, $providers, 'Service provider is not being loaded.');
        $this->assertTrue($providers[$pagarme], 'Service provider is not being loaded.');
    }
}
