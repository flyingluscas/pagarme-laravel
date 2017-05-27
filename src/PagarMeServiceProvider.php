<?php

namespace FlyingLuscas\PagarMeLaravel;

use PagarMe\Sdk\PagarMe;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class PagarMeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $configFile = __DIR__.'/../config/pagarme.php';

        $this->mergeConfigFrom($configFile, 'pagarme');

        $this->publishes([
            $configFile => config_path('pagarme.php'),
        ]);

        $this->registerCheckoutBladeDirective();
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('PagarMe', function ($app) {
            return new PagarMe(
                $app->config->get('pagarme.keys.api')
            );
        });

        $this->app->singleton('PagarMe.Checkout', function ($app) {
            return new CheckoutButton([
                'encryption-key' => $app->config->get('pagarme.keys.encryption'),
            ]);
        });
    }

    /**
     * Register blade directive.
     *
     * @return void
     */
    private function registerCheckoutBladeDirective()
    {
        $this->app->make(BladeCompiler::class)->directive('checkout', function ($attributes) {
            if ($attributes) {
                return '<?php echo app(\'PagarMe.Checkout\')->withAttributes('.$attributes.')->render(); ?>';
            }

            return '<?php echo app(\'PagarMe.Checkout\')->render(); ?>';
        });
    }
}
