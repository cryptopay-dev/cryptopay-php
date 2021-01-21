<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

$id = '457a56dc-6628-4881-b5fc-bb8628211464';

try {
    $response = $cryptopay->getCoinWithdrawal($id);
} catch (CryptopayException $exception) {
    echo sprintf("Unable to get invoice. Error: %s \n", $exception->getMessage());
    die();
}
print_r($response);
