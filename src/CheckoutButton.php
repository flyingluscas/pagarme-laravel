<?php

namespace FlyingLuscas\PagarMeLaravel;

class CheckoutButton
{
    /**
     * Button attribues.
     *
     * @var array
     */
    protected $attribues = [
        'type' => 'text/javascript',
        'src' => 'https://assets.pagar.me/checkout/checkout.js',
    ];

    /**
     * Creates a new class instance.
     *
     * @param array|null $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->attribues = array_merge($this->attribues, $attributes);
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
     * Set button attributes.
     *
     * @param string $name
     * @param string $value
     *
     * @return self
     */
    public function setAttribute($name, $value)
    {
        $this->attribues[$name] = $value;

        return $this;
    }

    /**
     * Build HTML button.
     *
     * @return string
     */
    protected function buildHTML()
    {
        $attribues = implode(' ', array_map(function ($value, $name) {
            return sprintf('%s="%s"', $name, $value);
        }, $this->attribues, array_keys($this->attribues)));

        return '<script '.$attribues.'></script>';
    }
}
