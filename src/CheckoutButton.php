<?php

namespace FlyingLuscas\PagarMeLaravel;

class CheckoutButton
{
    const CDN_SCRIPT = 'https://assets.pagar.me/checkout/checkout.js';

    /**
     * Default attributes.
     *
     * @var array
     */
    protected $attributes = [
        'type' => 'text/javascript',
        'src' => self::CDN_SCRIPT,
    ];

    /**
     * Data attributes.
     *
     * @var array
     */
    protected $dataAttributes = [];

    /**
     * Creates a new class instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        if ($attributes) {
            $this->withAttributes($attributes);
        }
    }

    /**
     * Render checkout button.
     *
     * @param  array  $attributes
     *
     * @return string
     */
    public function render(array $attributes = [])
    {
        if ($attributes) {
            $this->withAttributes($attributes);
        }

        return $this->buildHTML();
    }

    /**
     * Mass assign attributes.
     *
     * @param  array  $attributes
     *
     * @return self
     */
    public function withAttributes(array $attributes)
    {
        $attributes = array_merge($this->dataAttributes, $attributes);

        foreach ($attributes as $name => $value) {
            $this->setDataAttribute($name, $value);
        }

        return $this;
    }

    /**
     * Sets the amount value.
     *
     * @param  int|float $value
     *
     * @return self
     */
    public function amount($value)
    {
        $this->setDataAttribute(
            'amount',
            $this->getAmountInCentsFormat($value)
        );

        return $this;
    }

    /**
     * Sets billet discount amount.
     *
     * @param  int|float $value
     *
     * @return self
     */
    public function billetDiscountAmount($value)
    {
        $this->setDataAttribute(
            'boleto-discount-amount',
            $this->getAmountInCentsFormat($value)
        );

        return $this;
    }

    /**
     * Get the amount value in cents.
     *
     * @param  int|float $value
     *
     * @return string
     */
    protected function getAmountInCentsFormat($value)
    {
        if (! strrpos($value, '.')) {
            return $value.'00';
        }

        list($value, $decimals) = explode('.', $value);

        return $value.str_pad($decimals, 2, '0');
    }

    /**
     * Sets data attributes.
     *
     * @param string $name
     * @param string $value
     *
     * @return self
     */
    protected function setDataAttribute($name, $value)
    {
        if (! preg_match('/^data\-/', $name)) {
            $name = 'data-'.$name;
        }

        $this->dataAttributes[$name] = $value;

        return $this;
    }

    /**
     * Build HTML script tag.
     *
     * @return string
     */
    protected function buildHTML()
    {
        $attributes = array_merge($this->attributes, $this->dataAttributes);

        $attributesHTMLSyntax = implode(' ', array_map(function ($value, $name) {
            return sprintf('%s="%s"', $name, $value);
        }, $attributes, array_keys($attributes)));

        return '<script '.$attributesHTMLSyntax.'></script>';
    }
}
