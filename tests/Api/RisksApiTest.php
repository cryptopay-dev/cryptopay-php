<?php

// Auto-generated file
// DO NOT EDIT

namespace Tests;

use Cryptopay\Cryptopay;
use VCR\VCR;

class RisksApiTest extends ApiTest
{
    public function testscore()
    {
        VCR::insertCassette('risks/score.yml');

        $cryptopay = new Cryptopay($this->config);

        $params = [
        'address' => '2N9wPGx67zdSeAbXi15qHgoZ9Hb9Uxhd2uQ',
        'currency' => 'BTC',
        'type' => 'source_of_funds'
        ];

        $result = $cryptopay->risks->score($params);

        $this->assertNotNull($result);
    }
}
