<?php

use Cryptopay\Exceptions\CryptopayException;

require_once dirname(__DIR__) . '/Init.php';

$channelId = '69767fab-9936-4788-a578-2b8b20d8b1f1';

$channelData = [
    'name' => 'TestChannel3',
    'description' => '#3Channel'
];

try {
    $response = $cryptopay->updateChannel($channelId, $channelData);
} catch (CryptopayException $exception) {
    echo sprintf("Unable to update channel. %s \n", $exception->getMessage());
    die();
}

print_r($response);
