<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

try {
    $response = $cryptopay->getCoinWithdrawals();
    print_r($response);
} catch (CryptopayException $exception) {
    echo sprintf("Can't get coin withdrawal list. Error: %s \n", $exception->getMessage());
    die();
}
