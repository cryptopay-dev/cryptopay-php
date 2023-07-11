<?php

// Auto-generated file
// DO NOT EDIT

namespace Tests;

use Cryptopay\Cryptopay;
use VCR\VCR;

class AccountsApiTest extends ApiTest
{
    public function testall()
    {
        VCR::insertCassette('accounts/all.yml');

        $cryptopay = new Cryptopay($this->config);

        $result = $cryptopay->accounts->all();

        $this->assertNotNull($result);
    }

    public function testallTransactions()
    {
        VCR::insertCassette('accounts/allTransactions.yml');

        $cryptopay = new Cryptopay($this->config);

        $accountId = '31804390-d44e-49e9-8698-ca781e0eb806';

        $result = $cryptopay->accounts->allTransactions($accountId);

        $this->assertNotNull($result);
    }
}
