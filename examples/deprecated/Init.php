<?php

// path to autoload
require_once dirname(__DIR__) . "/../vendor/autoload.php";

use Cryptopay\Config\Config;
use Cryptopay\Cryptopay;

$config = (new Config())
    ->withApiKey(getenv('CRYPTOPAY_API_KEY'))
    ->withApiSecret(getenv('CRYPTOPAY_API_SECRET'))
    ->withBaseUrl('https://business-sandbox.cryptopay.me')
    ->withCallbackSecret('YOUR_CALLBACK_SECRET_VALUE')
    ->withTimeout(10);

$cryptopay = new Cryptopay($config);
