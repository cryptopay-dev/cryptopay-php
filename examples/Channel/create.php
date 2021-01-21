<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

// customer_id not implemented in this version

$channelData = [
    'pay_currency' => 'BTC',
    'receiver_currency' => 'BTC',
    'custom_id' => '2',
    'name' => 'TestChannel',
    'description' => '#2Channel'
];

try {
    $response = $cryptopay->createChannel($channelData);
} catch (CryptopayException $exception) {
    echo sprintf("Unable to create channel. %s \n", $exception->getMessage());
    die();
}

print_r($response);
