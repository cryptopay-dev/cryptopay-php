<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

$channelId = '130c4b3c-7281-4cf6-852a-76a05b7b53151';

try {
    $response = $cryptopay->getChannelPayments($channelId);
} catch (CryptopayException $exception) {
    echo sprintf("Unable to get channel %s payments. Error: %s \n", $channelId, $exception->getMessage());
    die();
}
print_r($response);
