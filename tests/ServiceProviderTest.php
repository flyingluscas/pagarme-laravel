<?php

namespace FlyingLuscas\PagarMeLaravel;

class ServiceProviderTest extends TestCase
{
    public function testIfServiceProviderIsBeingRegistered()
    {
        $pagarme = PagarMeServiceProvider::class;
        $providers = $this->app->getLoadedProviders();

        $this->assertArrayHasKey($pagarme, $providers);
        $this->assertTrue($providers[$pagarme]);
    }
}
