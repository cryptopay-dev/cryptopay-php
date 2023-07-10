<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

$channelId = '130c4b3c-7281-4cf6-852a-76a05b7b5315';
$paymentId = '97aef8f1-4948-43ef-b0be-c59cd62ad4ca';

try {
    $response = $cryptopay->getChannelPayment($channelId, $paymentId);
} catch (CryptopayException $exception) {
    echo sprintf(
        "Unable to get channel #%s payment #%s. Error: %s \n",
        $channelId,
        $paymentId,
        $exception->getMessage()
    );
    die();
}
print_r($response);
