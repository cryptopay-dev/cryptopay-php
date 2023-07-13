<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

$id = 'd38f0f56-1c1d-4830-9c2b-499bc1c03242';

try {
    $response = $cryptopay->commitCoinWithdrawal($id);
    print_r($response);
} catch (CryptopayException $exception) {
    echo sprintf("Unable to commit coin withdrawal. %s \n", $exception->getMessage());
    die();
}
