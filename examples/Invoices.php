<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/examples/Init.php';

try {
    $response = $cryptopay->invoices->create([
        'price_amount' => '100',
        'price_currency' => 'EUR',
        'pay_currency' => 'BTC'
    ]);
} catch (CryptopayException $exception) {
    echo sprintf("Unable to create Invoice. %s \n", $exception->getMessage());
    die();
}

print_r($response);
