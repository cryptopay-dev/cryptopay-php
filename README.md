# Cryptopay API #

The official PHP library for Cryptopay API.

### Table of Сontents ###

* [Versions](#versions)
* [Documentation](#documentation)
* [Setup](#setup)
* [Request / Response](#request--response)
* [Exception](#exceptions)
* [Usage](#usage)
* [Examples](#examples)
* [Webhooks](#webhooks)
* [Testing and Contributing](#testing)


<a name="versions"></a>
### VERSIONS ###

Client works with PHP version 7.3 or higher and depends on:
* "guzzlehttp/guzzle": 7.2 or higher
* "vlucas/phpdotenv": "5.2" or higher
* "squizlabs/php_codesniffer": 3.5 or higher

<a name="documentation"></a>
### Documentation ###
For more details visit [CryptopayAPI](https://developers.cryptopay.me)

To start using this library, register an account on
    [Cryptopay Sandbox](https://business-sandbox.cryptopay.me/)
    [Guide](https://developers.cryptopay.me/guides/creating-a-test-account)
or
    [Cryptopay Live](https://business.cryptopay.me/)

You should have the following 3 parameters:
~~~~
ApiKey, ApiSecret, CallbackApiSecret
~~~~

<a name="setup"></a>
### Setup ###

1. Make sure you have [composer](https://getcomposer.org/download/) installed

2. Go to project folder<br/>
    cd ~/projects/your_project_name

3. Run composer require  "cryptopay-dev/cryptopay"

    (3) Or you can add it manually.

    Open your composer.json file and add a line in the end of "require" section<br/>

        "require": {
            ...,
            "cryptopay-dev/cryptopay": "master"
        },

4. After the package is successful installed, you need to configure it.

    If you use a PHP framework such as Laravel, composer packages will be included automatically.
    Otherwise, you need to require a path to "vendor/autoload.php" in a file that your code is located.

    After that initialize the package with the following parameters:

        $config = (new Config())
            ->withApiKey('API_KEY_VALUE')
            ->withApiSecret('YOUR_SECRET_VALUE')
            ->withBaseUrl('https://business-sandbox.cryptopay.me')
            ->withCallbackSecret('YOUR_CALLBACK_SECRET_VALUE')
            ->withTimeout(10);

        $cryptopay = new Cryptopay($config);

    You can also pass: baseUrl, CallbackApiSecret, timeout values.

    Example: [examples/Init.php](https://github.com/cryptopay-dev/cryptopay-php/blob/master/examples/Init.php)

    Well done - you're good to go.

5. Alternatively, you can use a .env file with parameters to configure it.

    To do so, you should omit initialization in Step 4.

    Create a new "config" folder in the Project folder. If the "config" folder already exists, open it and create a new 'cryptopay.env' file.

    The structure of config/cryptopay.env:

        CRYPTOPAY_API_KEY=API_KEY_VALUE
        CRYPTOPAY_API_SECRET=YOUR_SECRET_VALUE
        CRYPTOPAY_BASE_URL=https://business-sandbox.cryptopay.me
        CRYPTOPAY_TIMEOUT=10
        CRYPTOPAY_CALLBACK_SECRET=YOUR_CALLBACK_SECRET_VALUE

    Then init Cryptopay library in your project:

        $config = (new ConfigEnv())->init();
        $cryptopay = new Cryptopay($config);

    Example: [examples/InitWithEnv.php](https://github.com/cryptopay-dev/cryptopay-php/blob/master/examples/InitWithEnv.php)

<a name="request--response"></a>
### Request / Response ###
All requests are signed with [Authorization](https://developers.cryptopay.me/guides/api-basics/authentication)
algorythm and then sent to the API through GuzzleClient.

By default, Cryptopay API returns JSON response. This package transforms json response to object and return it to the client.

<a name="exceptions"></a>
### Exceptions ###
Exception Structure
~~~~
\Exception
    \Cryptopay\CryptopayException
        \Cryptopay\Exceptions\ConfigException
        \Cryptopay\Exceptions\CallbackExceptions
        \Cryptopay\Exceptions\ForbiddenException
        \Cryptopay\Exceptions\RequestException
        \Cryptopay\Exceptions\UuidException
        \Cryptopay\Exceptions\DirectoryException
~~~~

Exception class         | Response Code
----------------------- | -------------
RequestException        | *
ConfigException         | 422
CallbackException       | 422
ForbiddenException      | 403
UuidException           | 422
DirectoryException      | 422

<a name="usage"></a>
### Usage ###

~~~
<?php

    // path to autoload
    require_once dirname(__DIR__) . "/vendor/autoload.php";

    use Cryptopay\Config\Config;
    use Cryptopay\Cryptopay;

    //Configuration for Cryptopay
    $config = (new Config())
        ->withApiKey('API_KEY_VALUE')
        ->withApiSecret('YOUR_SECRET_VALUE')
        ->withBaseUrl('https://business-sandbox.cryptopay.me')
        ->withCallbackSecret('YOUR_CALLBACK_SECRET_VALUE')
        ->withTimeout(10);

    $cryptopay = new Cryptopay($config);

    try {
        $response = $cryptopay->getInvoices('366fcd88-2d90-47b3-bdfb-5d3e3e8d8550');
    } catch (CryptopayException $e) {
        echo sprintf("Cant get invoices list. Error: %s \n", $exception->getMessage());
        die();
    }
    print_r($response);
~~~

<a name="examples"></a>
### Examples ###

You can find more examples in `examples` folder.

<a name="callbacks"></a>
### Callbacks ###

[Documentation](https://developers.cryptopay.me/guides/api-basics/callbacks)

All callbacks need to be validated with
[signature](https://developers.cryptopay.me/guides/api-basics/authentication/signature)

    <?php
        //....Initialization
        // get CallbackJson
        $callbackJson = file_get_contents('php://input');

        // Get headers
        $headers = getallheaders();

        $cryptopay->validateCallback($callbackJson, $headers);
    ?>

If the signature is wrong, the package validation will throw ForbiddenException.
Otherwise, it will return object

<a name="testing"></a>
### Testing ###
To run test type in terminal

<code>composer test</code>
