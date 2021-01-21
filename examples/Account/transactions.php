<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

$accountId = '13fb0304-0ce4-432b-b753-cd567ab82b1b1111';
$afterId = 'a2f93513-3870-4c4e-8baa-00bbc3114006';

try {
    $response = $cryptopay->getAccountTransactions($accountId, $afterId);
} catch (CryptopayException $exception) {
    echo sprintf("Cant get account %s transaction list. Error: %s \n", $accountId, $exception->getMessage());
    die();
}

print_r($response);
