<?php

// Auto-generated file
// DO NOT EDIT

namespace Tests;

use Cryptopay\Cryptopay;
use VCR\VCR;

class CoinWithdrawalsApiTest extends ApiTest
{
    public function testall()
    {
        VCR::insertCassette('coinWithdrawals/all.yml');

        $cryptopay = new Cryptopay($this->config);

        $result = $cryptopay->coinWithdrawals->all();

        $this->assertNotNull($result);
    }

    public function testcommit()
    {
        VCR::insertCassette('coinWithdrawals/commit.yml');

        $cryptopay = new Cryptopay($this->config);

        $coinWithdrawal = $cryptopay->coinWithdrawals->create([
        'address' => '2Mz3bcjSVHG8uQJpNjmCxp24VdTjwaqmFcJ',
        'charged_amount' => '100.0',
        'charged_currency' => 'EUR',
        'received_currency' => 'BTC',
        'force_commit' => false
        ])->data;

        $result = $cryptopay->coinWithdrawals->commit($coinWithdrawal->id);

        $this->assertNotNull($result);
    }

    public function testcreate()
    {
        VCR::insertCassette('coinWithdrawals/create.yml');

        $cryptopay = new Cryptopay($this->config);

        $params = [
        'address' => '2Mz3bcjSVHG8uQJpNjmCxp24VdTjwaqmFcJ',
        'charged_amount' => '100.0',
        'charged_currency' => 'EUR',
        'received_currency' => 'BTC',
        'force_commit' => true
        ];

        $result = $cryptopay->coinWithdrawals->create($params);

        $this->assertNotNull($result);
    }

    public function testallNetworkFees()
    {
        VCR::insertCassette('coinWithdrawals/allNetworkFees.yml');

        $cryptopay = new Cryptopay($this->config);

        $result = $cryptopay->coinWithdrawals->allNetworkFees();

        $this->assertNotNull($result);
    }

    public function testretrieve()
    {
        VCR::insertCassette('coinWithdrawals/retrieve.yml');

        $cryptopay = new Cryptopay($this->config);

        $coinWithdrawalId = '3cf9d1c4-6191-4826-8cae-2c717810c7e9';

        $result = $cryptopay->coinWithdrawals->retrieve($coinWithdrawalId);

        $this->assertNotNull($result);
    }

    public function testretrieveByCustomId()
    {
        VCR::insertCassette('coinWithdrawals/retrieveByCustomId.yml');

        $cryptopay = new Cryptopay($this->config);

        $customId = 'PAYMENT-123';

        $result = $cryptopay->coinWithdrawals->retrieveByCustomId($customId);

        $this->assertNotNull($result);
    }
}
