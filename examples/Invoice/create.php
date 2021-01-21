<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

$invoiceData = [
    'price_amount' => "0.00018704",
    'price_currency' => 'BTC',
    'pay_currency' => 'BTC',
    'custom_id' => '1',
    'name' => 'Test',
    'description' => '#1'
];

try {
    $response = $cryptopay->createInvoice($invoiceData);
} catch (CryptopayException $exception) {
    echo sprintf("Unable to create Invoice. %s \n", $exception->getMessage());
    die();
}

print_r($response);
