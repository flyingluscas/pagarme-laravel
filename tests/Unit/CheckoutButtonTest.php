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
        $this->assertButtonHasAttribute('type', 'text/javascript');
        $this->assertButtonHasAttribute('src', 'https://assets.pagar.me/checkout/checkout.js');
    }

    public function testIfCanSetAttribute()
    {
        $this->button->setDataAttribute(100, 'amount');
        $this->button->setDataAttribute('Pagar', 'data-button-text');

        $this->assertButtonHasAttribute('data-amount', 100);
        $this->assertButtonHasAttribute('data-button-text', 'Pagar');
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
