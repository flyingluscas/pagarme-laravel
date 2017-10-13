<?php

namespace FlyingLuscas\PagarMeLaravel;

class FindTransactionTest extends TestCase
{
    public function testFindTransactionById()
    {
        $expectedTransactionId = $this->createBoletoTransaction()->id;
        $foundTransaction = $this->pagarme
            ->transactions()
            ->find($expectedTransactionId);

        $this->assertEquals($foundTransaction->id, $expectedTransactionId);
    }
}
