<?php

// Auto-generated file
// DO NOT EDIT

namespace Tests;

use Cryptopay\Cryptopay;
use VCR\VCR;

class ExchangeTransfersApiTest extends ApiTest
{
    public function testcommit()
    {
        VCR::insertCassette('exchangeTransfers/commit.yml');

        $cryptopay = new Cryptopay($this->config);

        $exchangeTransfer = $cryptopay->exchangeTransfers->create([
        'charged_currency' => 'EUR',
        'charged_amount' => '100.0',
        'received_currency' => 'BTC',
        'received_amount' => null,
        'force_commit' => false
        ])->data;

        $result = $cryptopay->exchangeTransfers->commit($exchangeTransfer->id);

        $this->assertNotNull($result);
    }

    public function testcreate()
    {
        VCR::insertCassette('exchangeTransfers/create.yml');

        $cryptopay = new Cryptopay($this->config);

        $params = [
        'charged_currency' => 'EUR',
        'charged_amount' => '100.0',
        'received_currency' => 'BTC',
        'received_amount' => null,
        'force_commit' => true
        ];

        $result = $cryptopay->exchangeTransfers->create($params);

        $this->assertNotNull($result);
    }

    public function testretrieve()
    {
        VCR::insertCassette('exchangeTransfers/retrieve.yml');

        $cryptopay = new Cryptopay($this->config);

        $exchangeTransferId = '2c090f99-7cc1-40da-9bca-7caa57b4ebfb';

        $result = $cryptopay->exchangeTransfers->retrieve($exchangeTransferId);

        $this->assertNotNull($result);
    }
}
