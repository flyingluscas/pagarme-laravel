<?php

namespace FlyingLuscas\PagarMeLaravel;

class FilterTransactionsTest extends TestCase
{
    /**
     * @dataProvider filtersProvider
     */
    public function testFilterTransactions($filter, $value)
    {
        $this->createBoletoTransaction();
        $this->createCreditCardTransaction();

        $transactions = $this->pagarme->transactions()->filter([
            $filter => $value,
        ]);

        $this->assertTrue(count($transactions) > 0, 'No transactions were found!');

        foreach ($transactions as $transaction) {
            $this->assertEquals($transaction->{$filter}, $value);
        }
    }

    public function filtersProvider()
    {
        return [
            ['payment_method', 'boleto'],
            ['payment_method', 'credit_card'],
        ];
    }
}
