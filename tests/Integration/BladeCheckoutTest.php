<?php

namespace FlyingLuscas\PagarMeLaravel;

use Illuminate\View\Compilers\BladeCompiler;

class BladeCheckoutTest extends IntegrationTestCase
{
    /**
     * Blade compiler.
     *
     * @var \Illuminate\View\Compilers\BladeCompiler
     */
    protected $blade;

    public function setUp()
    {
        parent::setUp();

        $this->blade = $this->app->make(BladeCompiler::class);
    }

    public function testIfBladeDirectiveIsRegistered()
    {
        $this->assertArrayHasKey('checkout', $this->blade->getCustomDirectives());
    }

    public function testDirectiveCanRenderWithoutAttributes()
    {
        $this->assertEquals(
            '<?php echo app(\'PagarMe.Checkout\')->render(); ?>',
            $this->blade->compileString('@checkout')
        );
    }

    public function testDirectiveCanRenderWithAttributes()
    {
        $this->assertEquals(
            '<?php echo app(\'PagarMe.Checkout\')->withAttributes([\'amount\' => 100])->render(); ?>',
            $this->blade->compileString('@checkout ([\'amount\' => 100])')
        );
    }
}
