<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

try {
    $response = $cryptopay->getAccounts();
} catch (CryptopayException $exception) {
    echo sprintf("Cant get accounts list. Error: %s \n", $exception->getMessage());
    die();
}

print_r($response);
