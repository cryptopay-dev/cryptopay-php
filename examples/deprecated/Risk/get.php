<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

$address = '2NDSMEM2dicJDb7xHjcxVGGz2xgzXeWGmRC1';
$riskRequest = [
    'type' => 'destination_of_funds',
    'address' => '2NDSMEM2dicJDb7xHjcxVGGz2xgzXeWGmRC',
    'currency' => 'BTC',
];

try {
    $response = $cryptopay->getRisks($riskRequest);
} catch (CryptopayException $exception) {
    echo sprintf("Unable to get risks for address %s. Error: %s \n", $address, $exception->getMessage());
    die();
}
print_r($response);
