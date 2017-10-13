<?php

namespace FlyingLuscas\PagarMeLaravel;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Pagar.me's API Key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Pagar.me Client.
     *
     * @var \FlyingLuscas\PagarMeLaravel\PagarMe
     */
    protected $pagarme;

    public function setUp()
    {
        parent::setUp();

        $this->apiKey = $this->createTemporaryCompany()->api_key->test;
        $this->pagarme = new PagarMe($this->apiKey);
    }

    /**
     * Creates a temporary company to be used while testing.
     *
     * @param  array  $payload
     * @return object
     */
    protected function createTemporaryCompany(array $payload = [])
    {
        $http = new \GuzzleHttp\Client;
        $default = [
            'api_version' => [
                'live' => '2013-03-01',
                'test' => '2013-03-01',
            ],
        ];

        $response = $http->request('POST', 'https://api.pagar.me/1/companies/temporary', [
            'json' => array_merge_recursive($default, $payload),
        ]);

        return json_decode($response->getBody()->getContents());
    }

    protected function createBoletoTransaction(array $payload = [])
    {
        $http = new \GuzzleHttp\Client;
        $default = $this->getBoletoTransactionPayload();

        $response = $http->request('POST', 'https://api.pagar.me/1/transactions', [
            'query' => ['api_key' => $this->apiKey],
            'json' => array_merge_recursive($default, $payload),
        ]);

        return json_decode($response->getBody()->getContents());
    }

    protected function getBoletoTransactionPayload()
    {
        return [
            'amount' => 3100,
            'payment_method' => 'boleto',
            'customer' => [
                'name' => 'DON DIEGO DE LA VEGA',
                'email' => 'dondiegodel@vega.com',
                'document_number' => '34263759826',
                'address' => [
                  'zipcode' => '12010460',
                  'neighborhood' => 'Centro',
                  'street' => 'Edvardo Teixeira',
                  'street_number' => '152',
                ],
                'phone' => [
                  'number' => '912345678',
                  'ddd' => '11',
                ],
            ],
            'postback_url' => 'https://requestb.in/1nyheet1',
            'metadata' => [
                'idProduto' => '000000',
            ],
        ];
    }

    protected function getCreditCardTransactionPayload()
    {
        return [
            'card_number' => '4556366941062122',
            'card_cvv' => '111',
            'card_holder_name' => 'Aardvark da Silva',
            'card_expiration_date' => '1220',
            'customer' => [
                'email' => 'aardvark.silva@yahoo.com',
                'name' => 'Aardvark da Silva',
                'document_number' => '18152564000105',
                'address' => [
                    'zipcode' => '04571020',
                    'neighborhood' => 'Cidade Monções',
                    'street' => 'R. Dr. Geraldo Campos Moreira',
                    'street_number' => '240',
                ],
                'phone' => [
                    'number' => '987654321',
                    'ddd' => '11',
                ],
            ],
            'capture' => true,
            'installments' => 1,
            'payment_method' => 'credit_card',
            'amount' => 1000,
        ];
    }
}
