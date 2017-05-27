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

    public function testIfCanSetAttributes()
    {
        $this->assertInstanceOf(
            CheckoutButton::class,
            $this->button->withAttributes([
                'amount' => 100,
                'button-text' => 'Pagar',
            ])
        );

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

    /**
     * @dataProvider amountProvider
     */
    public function testIfCanSetBilletDiscountAmount($amount, $expected)
    {
        $this->assertInstanceOf(
            CheckoutButton::class,
            $this->button->billetDiscountAmount($amount)
        );

        $this->assertButtonHasAttribute('data-boleto-discount-amount', $expected);
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
