<?php

namespace FlyingLuscas\PagarMeLaravel;

abstract class BaseHandler
{
    /**
     * HTTP Client.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $http;

    /**
     * Get an instance of the base resource handler.
     *
     * @param \GuzzleHttp\ClientInterface $http
     */
    public function __construct(\GuzzleHttp\ClientInterface $http)
    {
        $this->http = $http;
    }
}
