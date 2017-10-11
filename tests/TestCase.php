<?php

namespace FlyingLuscas\PagarMeLaravel;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Creates a temporary company to be used while testing.
     *
     * @param  array  $payload
     * @return object
     */
    protected function createTemporaryCompany(array $payload = [])
    {
        $http = new \GuzzleHttp\Client;

        $response = $http->request('POST', 'https://api.pagar.me/1/companies/temporary', [
            'json' => $payload,
        ]);

        return json_decode(
            $response->getBody()->getContents()
        );
    }
}
