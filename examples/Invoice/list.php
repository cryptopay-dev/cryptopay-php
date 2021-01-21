<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

try {
    $response = $cryptopay->getInvoices('366fcd88-2d90-47b3-bdfb-5d3e3e8d8550');
} catch (CryptopayException $exception) {
    echo sprintf("Cant get invoices list. Error: %s \n", $exception->getMessage());
    die();
}

print_r($response);
