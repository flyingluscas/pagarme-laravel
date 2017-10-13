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
            'json' => $payload,
        ]);

        return json_decode($response->getBody()->getContents());
    }

    /**
     * Find transaction by ID.
     *
     * @param  int $id
     * @return object
     */
    public function find($id)
    {
        $response = $this->http->request('GET', "transactions/${id}");

        return json_decode($response->getBody()->getContents());
    }
}
