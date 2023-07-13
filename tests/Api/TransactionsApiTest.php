<?php

// Auto-generated file
// DO NOT EDIT

namespace Tests;

use Cryptopay\Cryptopay;
use VCR\VCR;

class TransactionsApiTest extends ApiTest
{
    public function testall()
    {
        VCR::insertCassette('transactions/all.yml');

        $cryptopay = new Cryptopay($this->config);

        $result = $cryptopay->transactions->all();

        $this->assertNotNull($result);
    }
}
