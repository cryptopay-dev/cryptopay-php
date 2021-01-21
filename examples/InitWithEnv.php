<?php

// path to autoload
require_once dirname(__DIR__) . "/vendor/autoload.php";

use Cryptopay\Config\ConfigEnv;
use Cryptopay\Cryptopay;

$config = (new ConfigEnv())->init();
$cryptopay = new Cryptopay($config);
