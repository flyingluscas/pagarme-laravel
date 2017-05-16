<?php

namespace FlyingLuscas\PagarMeLaravel;

class ServiceProviderTest extends TestCase
{
    public function testIsLoadingServiceProvider()
    {
        $pagarme = PagarMeServiceProvider::class;
        $providers = $this->app->getLoadedProviders();

        $this->assertArrayHasKey(
            $pagarme,
            $providers,
            'Service provider is not being loaded.'
        );
    }

    /**
     * @dataProvider getConfigKeys
     */
    public function testIsLoadingConfig($key)
    {
        $config = 'pagarme.'.$key;

        $this->assertTrue(
            $this->app->config->has($config),
            'The '.$config.' config is not being loaded.'
        );
    }

    /**
     * Provide a list of config keys that
     * must be loaded by the service provider.
     *
     * @return array
     */
    public function getConfigKeys()
    {
        return [
            ['api_key'],
            ['encryption_key'],
        ];
    }
}
