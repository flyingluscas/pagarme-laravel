<?php

namespace FlyingLuscas\PagarMeLaravel;

use PagarMe\Sdk\PagarMe;

class ServiceProviderTest extends IntegrationTestCase
{
    public function testIfTheServiceProviderWasLoaded()
    {
        $pagarme = PagarMeServiceProvider::class;
        $providers = $this->app->getLoadedProviders();

        $this->assertArrayHasKey($pagarme, $providers);
    }

    /**
     * @dataProvider getConfigKeys
     */
    public function testIfTheConfigFileWasLoaded($key)
    {
        $config = 'pagarme.'.$key;

        $this->assertTrue($this->app->config->has($config));
    }

    /**
     * Get a list of config keys that
     * must be loaded by the service provider.
     *
     * @return array
     */
    public function getConfigKeys()
    {
        return [
            ['keys.api'],
            ['keys.encryption'],
        ];
    }

    public function testIfTheConfigFileCanBePublished()
    {
        $configFile = $this->app->configPath().'/pagarme.php';

        $this->artisan('vendor:publish', [
            '--force' => true,
        ]);

        $this->assertFileExists($configFile);

        if (is_file($configFile)) {
            unlink($configFile);
        }
    }

    public function testIfThePagarMeClientIsBoundToTheContainer()
    {
        $this->assertInstanceOf(
            PagarMe::class,
            $this->app->make('PagarMe')
        );
    }

    public function testIfThePagarMeCheckoutButtonIsBoundToTheContainer()
    {
        $this->assertInstanceOf(
            CheckoutButton::class,
            $this->app->make('PagarMe.Checkout')
        );
    }
}
