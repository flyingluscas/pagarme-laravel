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
            'Service provider was not loaded.'
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

    public function testCanPublishConfigFile()
    {
        $configFile = $this->app->configPath('pagarme.php');

        $this->artisan('vendor:publish', [
            '--force' => true,
        ]);

        $this->assertFileExists(
            $configFile, 'Config file was not published.'
        );

        if (file_exists($configFile)) {
            unlink($configFile);
        }
    }
}
