<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

try {
    $response = $cryptopay->getChannels();
} catch (CryptopayException $exception) {
    echo sprintf("Cant get channels list. Error: %s \n", $exception->getMessage());
    die();
}

print_r($response);
