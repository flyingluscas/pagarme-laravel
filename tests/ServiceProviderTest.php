<?php

namespace FlyingLuscas\PagarMeLaravel;

use PagarMe\Sdk\PagarMe;

class ServiceProviderTest extends TestCase
{
    public function testIfTheServiceProviderWasLoaded()
    {
        $pagarme = PagarMeServiceProvider::class;
        $providers = $this->app->getLoadedProviders();

        $this->assertArrayHasKey(
            $pagarme,
            $providers,
            'Service provider was not loaded.'
        );
    }

    /**
     * @dataProvider getConfigKeys
     */
    public function testIfTheConfigFileWasLoaded($key)
    {
        $config = 'pagarme.'.$key;

        $this->assertTrue(
            $this->app->config->has($config),
            'Config '.$config.' was not found.'
        );
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
            ['api_key'],
            ['encryption_key'],
        ];
    }

    public function testIfTheConfigFileCanBePublished()
    {
        $configFile = $this->app->configPath().'/pagarme.php';

        $this->artisan('vendor:publish', [
            '--force' => true,
        ]);

        $this->assertFileExists(
            $configFile, 'Config file was not published.'
        );

        if (is_file($configFile)) {
            unlink($configFile);
        }
    }

    public function testIfThePagarMeClientIsBoundToTheContainer()
    {
        $this->assertInstanceOf(
            PagarMe::class,
            $this->app->make('PagarMe'),
            'The PagarMe class is not bound to the container.'
        );
    }
}
