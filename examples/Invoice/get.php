<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

$invoiceNumber = '366fcd88-2d90-47b3-bdfb-5d3e3e8d8550';

try {
    $response = $cryptopay->getInvoice($invoiceNumber);
} catch (CryptopayException $exception) {
    echo sprintf("Unable to get invoice. Error: %s \n", $exception->getMessage());
    die();
}
print_r($response);
