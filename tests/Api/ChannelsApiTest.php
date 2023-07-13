<?php

// Auto-generated file
// DO NOT EDIT

namespace Tests;

use Cryptopay\Cryptopay;
use VCR\VCR;

class ChannelsApiTest extends ApiTest
{
    public function testall()
    {
        VCR::insertCassette('channels/all.yml');

        $cryptopay = new Cryptopay($this->config);

        $result = $cryptopay->channels->all();

        $this->assertNotNull($result);
    }

    public function testcreate()
    {
        VCR::insertCassette('channels/create.yml');

        $cryptopay = new Cryptopay($this->config);

        $params = [
        'name' => 'Channel name',
        'pay_currency' => 'BTC',
        'receiver_currency' => 'EUR'
        ];

        $result = $cryptopay->channels->create($params);

        $this->assertNotNull($result);
    }

    public function testallPayments()
    {
        VCR::insertCassette('channels/allPayments.yml');

        $cryptopay = new Cryptopay($this->config);

        $channelId = '15d0bb11-1e9f-4295-bec5-abd9d5a906a1';

        $result = $cryptopay->channels->allPayments($channelId);

        $this->assertNotNull($result);
    }

    public function testretrieve()
    {
        VCR::insertCassette('channels/retrieve.yml');

        $cryptopay = new Cryptopay($this->config);

        $channelId = '15d0bb11-1e9f-4295-bec5-abd9d5a906a1';

        $result = $cryptopay->channels->retrieve($channelId);

        $this->assertNotNull($result);
    }

    public function testretrieveByCustomId()
    {
        VCR::insertCassette('channels/retrieveByCustomId.yml');

        $cryptopay = new Cryptopay($this->config);

        $customId = 'CHANNEL-123';

        $result = $cryptopay->channels->retrieveByCustomId($customId);

        $this->assertNotNull($result);
    }

    public function testretrievePayment()
    {
        VCR::insertCassette('channels/retrievePayment.yml');

        $cryptopay = new Cryptopay($this->config);

        $channelId = '15d0bb11-1e9f-4295-bec5-abd9d5a906a1';
        $channelPaymentId = '704291ec-0b90-4118-89aa-0c9681c3213c';

        $result = $cryptopay->channels->retrievePayment($channelId, $channelPaymentId);

        $this->assertNotNull($result);
    }

    public function testupdate()
    {
        VCR::insertCassette('channels/update.yml');

        $cryptopay = new Cryptopay($this->config);

        $channelId = '15d0bb11-1e9f-4295-bec5-abd9d5a906a1';
        $params = ['status' => 'disabled'];

        $result = $cryptopay->channels->update($channelId, $params);

        $this->assertNotNull($result);
    }
}
