<?php
use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

try {
    $response = $cryptopay->getTransactions();
} catch (CryptopayException $exception) {
    echo sprintf("Cant get transactions list. Error: %s \n", $exception->getMessage());
    die();
}
