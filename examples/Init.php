<?php

// path to autoload
require_once dirname(__DIR__) . "/vendor/autoload.php";

use Cryptopay\Config\Config;
use Cryptopay\Cryptopay;

$config = (new Config())
    ->withApiKey('API_KEY_VALUE')
    ->withApiSecret('YOUR_SECRET_VALUE')
    ->withBaseUrl('https://business-sandbox.cryptopay.me')
    ->withCallbackSecret('YOUR_CALLBACK_SECRET_VALUE')
    ->withTimeout(10);

$cryptopay = new Cryptopay($config);
