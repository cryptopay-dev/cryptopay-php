<?php

// Auto-generated file
// DO NOT EDIT

namespace Tests;

use Cryptopay\Cryptopay;
use VCR\VCR;

class SubscriptionsApiTest extends ApiTest
{
    public function testall()
    {
        VCR::insertCassette('subscriptions/all.yml');

        $cryptopay = new Cryptopay($this->config);

        $result = $cryptopay->subscriptions->all();

        $this->assertNotNull($result);
    }

    public function testcancel()
    {
        VCR::insertCassette('subscriptions/cancel.yml');

        $cryptopay = new Cryptopay($this->config);

        $subscriptionId = '7dd7da55-2fd6-445e-8c7c-6c2c85d135d7';

        $result = $cryptopay->subscriptions->cancel($subscriptionId);

        $this->assertNotNull($result);
    }

    public function testcreate()
    {
        VCR::insertCassette('subscriptions/create.yml');

        $cryptopay = new Cryptopay($this->config);

        $startsAt = (new \DateTime())->add(\DateInterval::createFromDateString('7 days'));
        $params = [
        'name' => 'Subscription name',
        'amount' => '100.0',
        'currency' => 'EUR',
        'period' => 'month',
        'period_quantity' => 3,
        'payer_email' => 'user@example.com',
        'starts_at' => $startsAt->format(\DateTime::ATOM)
        ];

        $result = $cryptopay->subscriptions->create($params);

        $this->assertNotNull($result);
    }

    public function testretrieve()
    {
        VCR::insertCassette('subscriptions/retrieve.yml');

        $cryptopay = new Cryptopay($this->config);

        $subscriptionId = '64249ede-8969-4d5c-a042-806f9c3e7db3';

        $result = $cryptopay->subscriptions->retrieve($subscriptionId);

        $this->assertNotNull($result);
    }

    public function testretrieveByCustomId()
    {
        VCR::insertCassette('subscriptions/retrieveByCustomId.yml');

        $cryptopay = new Cryptopay($this->config);

        $customId = 'PAYMENT-123';

        $result = $cryptopay->subscriptions->retrieveByCustomId($customId);

        $this->assertNotNull($result);
    }
}
