<?php

namespace FlyingLuscas\PagarMeLaravel;

class PagarMe
{
    /**
     * Pagar.me's API Key.
     *
     * @var string
     */
    private $apiKey;

    /**
     * HTTP Client.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    private $http;

    /**
     * Get PagarMe client instance.
     *
     * @param string                           $apiKey
     * @param \GuzzleHttp\ClientInterface|null $http
     */
    public function __construct(
        $apiKey,
        \GuzzleHttp\ClientInterface $http = null
    ) {
        $this->apiKey = $apiKey;
        $this->http = $http ?: new \GuzzleHttp\Client([
            'base_uri' => 'https://api.pagar.me/1/',
        ]);
    }

    /**
     * Get the transactions handler.
     *
     * @return \FlyingLuscas\PagarMeLaravel\Transactions\Handler
     */
    public function transactions()
    {
        return new \FlyingLuscas\PagarMeLaravel\Transactions\Handler(
            $this->apiKey,
            $this->http
        );
    }
}
