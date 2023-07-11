<?php

// Auto-generated file
// DO NOT EDIT

namespace Tests;

use Cryptopay\Cryptopay;
use VCR\VCR;

class InvoicesApiTest extends ApiTest
{
    public function testall()
    {
        VCR::insertCassette('invoices/all.yml');

        $cryptopay = new Cryptopay($this->config);

        $result = $cryptopay->invoices->all();

        $this->assertNotNull($result);
    }

    public function testcommitRecalculation()
    {
        VCR::insertCassette('invoices/commitRecalculation.yml');

        $cryptopay = new Cryptopay($this->config);

        $invoiceId = '8dd53e0f-0725-48b4-b0a7-1840aa67b5bb';
        $recalculation = $cryptopay->invoices->createRecalculation($invoiceId)->data;

        $result = $cryptopay->invoices->commitRecalculation($invoiceId, $recalculation->id);

        $this->assertNotNull($result);
    }

    public function testcreate()
    {
        VCR::insertCassette('invoices/create.yml');

        $cryptopay = new Cryptopay($this->config);

        $params = [
        'price_amount' => '100.0',
        'price_currency' => 'EUR',
        'pay_currency' => 'BTC'
        ];

        $result = $cryptopay->invoices->create($params);

        $this->assertNotNull($result);
    }

    public function testcreateRecalculation()
    {
        VCR::insertCassette('invoices/createRecalculation.yml');

        $cryptopay = new Cryptopay($this->config);

        $invoiceId = '29a563ad-b417-445c-b8f6-b6c806bb039b';
        $params = ['force_commit' => true];

        $result = $cryptopay->invoices->createRecalculation($invoiceId, $params);

        $this->assertNotNull($result);
    }

    public function testcreateRefund()
    {
        VCR::insertCassette('invoices/createRefund.yml');

        $cryptopay = new Cryptopay($this->config);

        $invoiceId = '331646a6-c8b5-430d-adfb-021d11ff6cd0';
        $params = ['address' => '0xf3532c1fd002665ec54d46a50787e0c69c76cd44'];

        $result = $cryptopay->invoices->createRefund($invoiceId, $params);

        $this->assertNotNull($result);
    }

    public function testallRefunds()
    {
        VCR::insertCassette('invoices/allRefunds.yml');

        $cryptopay = new Cryptopay($this->config);

        $invoiceId = '7e274430-e20f-4321-8748-20824287ae44';

        $result = $cryptopay->invoices->allRefunds($invoiceId);

        $this->assertNotNull($result);
    }

    public function testretrieve()
    {
        VCR::insertCassette('invoices/retrieve.yml');

        $cryptopay = new Cryptopay($this->config);

        $invoiceId = 'c8233d57-78c8-4c36-b35e-940ae9067c78';

        $result = $cryptopay->invoices->retrieve($invoiceId);

        $this->assertNotNull($result);
    }

    public function testretrieveByCustomId()
    {
        VCR::insertCassette('invoices/retrieveByCustomId.yml');

        $cryptopay = new Cryptopay($this->config);

        $customId = 'PAYMENT-123';

        $result = $cryptopay->invoices->retrieveByCustomId($customId);

        $this->assertNotNull($result);
    }
}
