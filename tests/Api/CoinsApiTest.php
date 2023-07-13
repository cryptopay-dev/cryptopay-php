<?php

// Auto-generated file
// DO NOT EDIT

namespace Tests;

use Cryptopay\Cryptopay;
use VCR\VCR;

class CoinsApiTest extends ApiTest
{
    public function testall()
    {
        VCR::insertCassette('coins/all.yml');

        $cryptopay = new Cryptopay($this->config);

        $result = $cryptopay->coins->all();

        $this->assertNotNull($result);
    }
}
