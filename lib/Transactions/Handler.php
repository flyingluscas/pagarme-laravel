<?php

namespace FlyingLuscas\PagarMeLaravel\Transactions;

use FlyingLuscas\PagarMeLaravel\BaseHandler;

class Handler extends BaseHandler
{
    /**
     * Create transactions.
     *
     * @param  array  $payload
     * @return object
     */
    public function create(array $payload)
    {
        $response = $this->http->request('POST', 'transactions', [
            'json' => array_merge([
                'api_key' => $this->apiKey,
            ], $payload),
        ]);

        return json_decode(
            $response->getBody()->getContents()
        );
    }
}
