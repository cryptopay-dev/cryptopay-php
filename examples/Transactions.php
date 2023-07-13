<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/examples/Init.php';

try {
    $response = $cryptopay->transactions->all([
        'status' => 'unresolved'
    ]);
} catch (CryptopayException $exception) {
    echo sprintf("Unable to get transactions list. %s \n", $exception->getMessage());
    die();
}

print_r($response);
