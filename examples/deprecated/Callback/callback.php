<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

$callbackJson = file_get_contents('php://input');

// Get headers
$headers = getallheaders();

try {
    $cryptopay->validateCallback($callbackJson, $headers);
} catch (CryptopayException $exception) {
    echo sprintf(
        " Callback validation error: %s \n",
        $exception->getMessage()
    );
    die();
}
