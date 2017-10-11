<?php

namespace FlyingLuscas\PagarMeLaravel;

abstract class BaseHandler
{
    /**
     * Pagar.me's API Key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * HTTP Client.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $http;

    /**
     * Get an instance of the base resource handler.
     *
     * @param string                      $apiKey
     * @param \GuzzleHttp\ClientInterface $http
     */
    public function __construct(
        $apiKey,
        \GuzzleHttp\ClientInterface $http
    ) {
        $this->apiKey = $apiKey;
        $this->http = $http;
    }
}
