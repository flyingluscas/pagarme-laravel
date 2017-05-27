<?php

namespace FlyingLuscas\PagarMeLaravel;

class CheckoutButton
{
    const CDN = 'https://assets.pagar.me/checkout/checkout.js';

    /**
     * Default attributes.
     *
     * @var array
     */
    protected $attributes = [
        'type' => 'text/javascript',
        'src' => self::CDN,
    ];

    /**
     * Data attributes.
     *
     * @var array
     */
    protected $dataAttribues = [];

    /**
     * Creates a new class instance.
     *
     * @param array|null $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->dataAttribues = array_map(
            [$this, 'setDataAttribute'],
            $attributes,
            array_keys($attributes)
        );
    }

    /**
     * Render checkout button.
     *
     * @return string
     */
    public function render()
    {
        return $this->buildHTML();
    }

    /**
     * Sets data attributes.
     *
     * @param string $value
     * @param string $name
     *
     * @return self
     */
    public function setDataAttribute($value, $name)
    {
        if (! preg_match('/^data\-/', $name)) {
            $name = 'data-'.$name;
        }

        $this->dataAttribues[$name] = $value;

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
        $this->setDataAttribute($this->getAmountInCentsFormat($value), 'amount');

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
     * Build HTML script tag.
     *
     * @return string
     */
    protected function buildHTML()
    {
        $attribues = array_merge($this->attributes, $this->dataAttribues);

        $attributesHTMLSyntax = implode(' ', array_map(function ($value, $name) {
            return sprintf('%s="%s"', $name, $value);
        }, $attribues, array_keys($attribues)));

        return '<script '.$attributesHTMLSyntax.'></script>';
    }
}
