<?php

namespace FlyingLuscas\PagarMeLaravel;

class CreateTransactionTest extends TestCase
{
    /**
     * @dataProvider transactionsPayloadProvider
     */
    public function testCreateTransaction($payload, $status)
    {
        $transaction = $this->pagarme
            ->transactions()
            ->create($payload);

        $this->assertEquals($transaction->status, $status);
    }

    public function transactionsPayloadProvider()
    {
        return [
            [$this->getCreditCardTransactionPayload(), 'paid'],
            [$this->getBoletoTransactionPayload(), 'waiting_payment'],
        ];
    }
}
