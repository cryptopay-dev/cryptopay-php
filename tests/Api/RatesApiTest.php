<?php

// Auto-generated file
// DO NOT EDIT

namespace Tests;

use Cryptopay\Cryptopay;
use VCR\VCR;

class RatesApiTest extends ApiTest
{
    public function testall()
    {
        VCR::insertCassette('rates/all.yml');

        $cryptopay = new Cryptopay($this->config);

        $result = $cryptopay->rates->all();

        $this->assertNotNull($result);
    }

    public function testretrieve()
    {
        VCR::insertCassette('rates/retrieve.yml');

        $cryptopay = new Cryptopay($this->config);

        $result = $cryptopay->rates->retrieve('BTC', 'EUR');

        $this->assertNotNull($result);
    }
}
