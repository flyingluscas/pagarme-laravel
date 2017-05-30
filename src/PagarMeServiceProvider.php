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

        $this->registerBladeDirective();
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->bindBladeCompilerIfNeeded();

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
     * Bind blade compiler for backwards
     * compatibility with Laravel 5.1 and 5.2.
     *
     * @return void
     */
    private function bindBladeCompilerIfNeeded()
    {
        if (! preg_match('/^5.(1|2)/', $this->app->version())) {
            return false;
        }

        $this->app->singleton(BladeCompiler::class, function ($app) {
            return new BladeCompiler(
                $app->files, $this->app->config->get('view.compiled')
            );
        });
    }

    /**
     * Register blade directive.
     *
     * @return void
     */
    private function registerBladeDirective()
    {
        $this->app->make(BladeCompiler::class)->directive('checkout', function ($attributes) {
            if ($attributes) {
                return '<?php echo app(\'PagarMe.Checkout\')->withAttributes'.$attributes.'->render(); ?>';
            }

            return '<?php echo app(\'PagarMe.Checkout\')->render(); ?>';
        });
    }
}
