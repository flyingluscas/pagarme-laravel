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

    public function testIfCanSetTheEncryptionKey()
    {
        $this->assertInstanceOf(
            CheckoutButton::class,
            $this->button->encryptionKey('example')
        );

        $this->assertButtonHasAttribute('data-encryption-key', 'example');
    }

    /**
     * @dataProvider amountProvider
     */
    public function testIfCanSetAmount($amount, $expected)
    {
        $this->assertInstanceOf(
            CheckoutButton::class,
            $this->button->amount($amount)
        );

        $this->assertButtonHasAttribute('data-amount', $expected);
    }

    public function amountProvider()
    {
        return [
            [14, '1400'],
            [14.7, '1470'],
            [14.79, '1479'],
            [1000, '100000'],
        ];
    }

    /**
     * @param  string $name
     * @param  mixed  $value
     *
     * @return void
     */
    protected function assertButtonHasAttribute($name, $value = null)
    {
        $renderedButton = $this->button->render();

        if (is_null($value)) {
            return $this->assertContains($name, $renderedButton);
        }

        return $this->assertContains(
            sprintf('%s="%s"', $name, $value),
            $renderedButton
        );
    }
}
