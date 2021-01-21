<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

$data = [
    'received_amount' => "0.00011",
    'address' => '2MxD4zPNgjpe2BWUJTiCJMVGzrWsmMRsRqv',
    'custom_id' => '3',
    'charged_currency' => 'BTC',
    'received_currency' => 'BTC'
];

try {
    $response = $cryptopay->createCoinWithdrawal($data);
    print_r($response);
} catch (CryptopayException $exception) {
    echo sprintf("Unable to create withdrawal. %s \n", $exception->getMessage());
    die();
}
