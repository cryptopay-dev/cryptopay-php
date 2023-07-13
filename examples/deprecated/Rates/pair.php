<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

try {
    $response = $cryptopay->getRatesPair('BTCUSD');
} catch (CryptopayException $exception) {
    echo sprintf("Unable to get rates. %s \n", $exception->getMessage());
    die();
}
print_r($response);
