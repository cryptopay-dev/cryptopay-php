<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

$channelId = '69767fab-9936-4788-a578-2b8b20d8b1f4';

try {
    $response = $cryptopay->getChannel($channelId);
} catch (CryptopayException $exception) {
    echo sprintf("Unable to get channel. Error: %s \n", $exception->getMessage());
    die();
}
print_r($response);
