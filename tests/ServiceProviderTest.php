<?php

namespace FlyingLuscas\PagarMeLaravel;

class ServiceProviderTest extends TestCase
{
    public function testIfServiceProviderIsBeingLoaded()
    {
        $pagarme = PagarMeServiceProvider::class;
        $providers = $this->app->getLoadedProviders();

        $this->assertArrayHasKey($pagarme, $providers);
        $this->assertTrue($providers[$pagarme]);
    }
}
