<?php

// Auto-generated file
// DO NOT EDIT

namespace Tests;

use Cryptopay\Cryptopay;
use VCR\VCR;

class CustomersApiTest extends ApiTest
{
    public function testall()
    {
        VCR::insertCassette('customers/all.yml');

        $cryptopay = new Cryptopay($this->config);

        $result = $cryptopay->customers->all();

        $this->assertNotNull($result);
    }

    public function testcreate()
    {
        VCR::insertCassette('customers/create.yml');

        $cryptopay = new Cryptopay($this->config);

        $params = [
        'id' => '56c8cb4112bc7df178ae804fa75f712b',
        'currency' => 'EUR'
        ];

        $result = $cryptopay->customers->create($params);

        $this->assertNotNull($result);
    }

    public function testretrieve()
    {
        VCR::insertCassette('customers/retrieve.yml');

        $cryptopay = new Cryptopay($this->config);

        $customerId = "CUSTOMER-123";

        $result = $cryptopay->customers->retrieve($customerId);

        $this->assertNotNull($result);
    }

    public function testupdate()
    {
        VCR::insertCassette('customers/update.yml');

        $cryptopay = new Cryptopay($this->config);

        $customerId = 'CUSTOMER-123';
        $params = [
        'addresses' => [
        [
        'address' => '2N9wPGx67zdSeAbXi15qHgoZ9Hb9Uxhd2uQ',
        'currency' => 'BTC',
        'network' => 'bitcoin'
        ]
        ]
        ];

        $result = $cryptopay->customers->update($customerId, $params);

        $this->assertNotNull($result);
    }
}
