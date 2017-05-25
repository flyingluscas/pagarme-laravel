<?php

namespace FlyingLuscas\PagarMeLaravel;

class CheckoutButtonTest extends UnitTestCase
{
    public function testIfCanRenderScriptTag()
    {
        $this->assertEquals(
            '<script type="text/javascript" src="https://assets.pagar.me/checkout/checkout.js"></script>',
            (new CheckoutButton)->render()
        );
    }

    public function testIfCanSetAttribute()
    {
        $button = (new CheckoutButton)
            ->setAttribute('data-amount', 100)
            ->render();

        $this->assertHasAttribute($button, 'data-amount', 100);
    }

    /**
     * Assert that HTML has an attribute.
     *
     * @param  string $haystack
     * @param  string $name
     * @param  mixed  $value
     *
     * @return void
     */
    protected function assertHasAttribute($haystack, $name, $value = null)
    {
        if (is_null($value)) {
            return $this->assertContains($name, $haystack);
        }

        return $this->assertContains(sprintf('%s="%s"', $name, $value), $haystack);
    }
}
