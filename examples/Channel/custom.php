<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

$customId = '1';

try {
    $response = $cryptopay->getCustomChannel($customId);
} catch (CryptopayException $exception) {
    echo sprintf("Unable to get custom invoice. Error: %s \n", $exception->getMessage());
    die();
}

print_r($response);
