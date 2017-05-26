<?php

namespace FlyingLuscas\PagarMeLaravel;

class CheckoutButtonTest extends UnitTestCase
{
    /**
     * @var \FlyingLuscas\PagarMeLaravel\CheckoutButton
     */
    protected $button;

    public function setUp()
    {
        $this->button = new CheckoutButton;
    }

    public function testIfCanRenderScriptTag()
    {
        $this->assertEquals(
            '<script type="text/javascript" src="https://assets.pagar.me/checkout/checkout.js"></script>',
            $this->button->render()
        );
    }

    public function testIfCanSetAttribute()
    {
        $this->button->setAttribute('data-amount', 100);

        $this->assertButtonHasAttribute('data-amount', 100);
    }

    /**
     * @param  string $name
     * @param  mixed  $value
     *
     * @return void
     */
    protected function assertButtonHasAttribute($name, $value = null)
    {
        if (is_null($value)) {
            return $this->assertContains(
                $name,
                $this->button->render()
            );
        }

        return $this->assertContains(
            sprintf('%s="%s"', $name, $value),
            $this->button->render()
        );
    }
}
