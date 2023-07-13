# Cryptopay PHP Library

The official PHP library for the Cryptopay API.

Cryptopay is a payment gateway and business wallet that allows merchants to automate the processes of accepting cryptocurrency payments and payouts from their customers, as well as making currency exchange transactions and receiving data on the transaction history and account balance statuses for reporting.

For more information, please visit [Cryptopay API docs](https://developers.cryptopay.me).

# Table of contents

* [Installation](#installation)
* [Configuration](#configuration)
* [Usage](#usage)
   * [Accounts](#accountsapi)
   * [Channels](#channelsapi)
   * [CoinWithdrawals](#coinwithdrawalsapi)
   * [Coins](#coinsapi)
   * [Customers](#customersapi)
   * [ExchangeTransfers](#exchangetransfersapi)
   * [Invoices](#invoicesapi)
   * [Rates](#ratesapi)
   * [Risks](#risksapi)
   * [Transactions](#transactionsapi)
* [Callbacks](#callbacks)

# Installation

## Requirements

* PHP 7.4+

## Composer

You can install the library via [Composer](https://getcomposer.org). Run the following command:

```
composer require cryptopay-dev/cryptopay
```

To use the library, use Composer's autoload:

```php
require_once 'vendor/autoload.php';
```

# Configuration

## Create API credentials

Learn mode about API credentials at [Developers guide](https://developers.cryptopay.me/guides/api-credentials).

## Configure library

```php
require_once 'vendor/autoload.php';

use Cryptopay\Config\Config;
use Cryptopay\Cryptopay;

$config = (new Config())
    ->withApiKey('API_KEY_VALUE')
    ->withApiSecret('YOUR_SECRET_VALUE')
    ->withBaseUrl('https://business-sandbox.cryptopay.me')
    ->withCallbackSecret('YOUR_CALLBACK_SECRET_VALUE')
    ->withTimeout(10);

$cryptopay = new Cryptopay($config);
```

Example: [examples/Init.php](https://github.com/cryptopay-dev/cryptopay-php/blob/master/examples/Init.php)

# Usage

## Accounts


### List accounts


```php
$result = $cryptopay->accounts->all();
```

### List account transactions


```php
$accountId = '31804390-d44e-49e9-8698-ca781e0eb806';

$result = $cryptopay->accounts->allTransactions($accountId);
```

## Channels

A channel is a static cryptocurrency address that may be assigned to each one of your customers.

[Channels API docs](https://developers.cryptopay.me/guides/channels)

### List channels


```php
$result = $cryptopay->channels->all();
```

### Create a channel


```php
$params = [
  'name' => 'Channel name',
  'pay_currency' => 'BTC',
  'receiver_currency' => 'EUR'
];

$result = $cryptopay->channels->create($params);
```

### List channel payments


```php
$channelId = '15d0bb11-1e9f-4295-bec5-abd9d5a906a1';

$result = $cryptopay->channels->allPayments($channelId);
```

### Retrieve a channel


```php
$channelId = '15d0bb11-1e9f-4295-bec5-abd9d5a906a1';

$result = $cryptopay->channels->retrieve($channelId);
```

### Retrieve a channel by custom id


```php
$customId = 'CHANNEL-123';

$result = $cryptopay->channels->retrieveByCustomId($customId);
```

### Retrieve a channel payment


```php
$channelId = '15d0bb11-1e9f-4295-bec5-abd9d5a906a1';
$channelPaymentId = '704291ec-0b90-4118-89aa-0c9681c3213c';

$result = $cryptopay->channels->retrievePayment($channelId, $channelPaymentId);
```

### Update a channel


```php
$channelId = '15d0bb11-1e9f-4295-bec5-abd9d5a906a1';
$params = ['status' => 'disabled'];

$result = $cryptopay->channels->update($channelId, $params);
```

## CoinWithdrawals

In addition to accepting payments through the Cryptopay payment gateway, it is also possible to make payments to your customers in any of the cryptocurrency currently supported by Cryptopay. In Cryptopay, these payments are called “Coin Withdrawal”. The process of requesting coin withdrawal is almost the same for a customer in Cashier as the process of making a deposit with one exception - the customer will need to specify the address of the wallet he wants to send the cryptocurrency to.

[Coin withdrawals API docs](https://developers.cryptopay.me/guides/payouts)

### List withdrawals


```php
$result = $cryptopay->coinWithdrawals->all();
```

### Commit a withdrawal


```php
$coinWithdrawal = $cryptopay->coinWithdrawals->create([
  'address' => '2Mz3bcjSVHG8uQJpNjmCxp24VdTjwaqmFcJ',
  'charged_amount' => '100.0',
  'charged_currency' => 'EUR',
  'received_currency' => 'BTC',
  'force_commit' => false
])->data;

$result = $cryptopay->coinWithdrawals->commit($coinWithdrawal->id);
```

### Create a withdrawal

[Documentation](https://developers.cryptopay.me/guides/payouts/create-a-coin-withdrawal)

```php
$params = [
  'address' => '2Mz3bcjSVHG8uQJpNjmCxp24VdTjwaqmFcJ',
  'charged_amount' => '100.0',
  'charged_currency' => 'EUR',
  'received_currency' => 'BTC',
  'force_commit' => true
];

$result = $cryptopay->coinWithdrawals->create($params);
```

### List network fees


```php
$result = $cryptopay->coinWithdrawals->allNetworkFees();
```

### Retrieve a withdrawal


```php
$coinWithdrawalId = '3cf9d1c4-6191-4826-8cae-2c717810c7e9';

$result = $cryptopay->coinWithdrawals->retrieve($coinWithdrawalId);
```

### Retrieve a withdrawal by custom id


```php
$customId = 'PAYMENT-123';

$result = $cryptopay->coinWithdrawals->retrieveByCustomId($customId);
```

## Coins


### List supported coins


```php
$result = $cryptopay->coins->all();
```

## Customers

Customer objects allow you to reject High-Risk transactions automatically, and to track multiple transactions, that are associated with the same customer.


### List customers


```php
$result = $cryptopay->customers->all();
```

### Create a customer


```php
$params = [
  'id' => '56c8cb4112bc7df178ae804fa75f712b',
  'currency' => 'EUR'
];

$result = $cryptopay->customers->create($params);
```

### Retrieve a customer


```php
$customerId = "CUSTOMER-123";

$result = $cryptopay->customers->retrieve($customerId);
```

### Update a customer


```php
$customerId = 'CUSTOMER-123';
$params = [
  'addresses' => [
    [
      'address' => '2N9wPGx67zdSeAbXi15qHgoZ9Hb9Uxhd2uQ',
      'currency' => 'BTC',
      'network' => 'bitcoin'
    ]
  ]
];

$result = $cryptopay->customers->update($customerId, $params);
```

## ExchangeTransfers


### Commit an exchange transfer


```php
$exchangeTransfer = $cryptopay->exchangeTransfers->create([
  'charged_currency' => 'EUR',
  'charged_amount' => '100.0',
  'received_currency' => 'BTC',
  'received_amount' => null,
  'force_commit' => false
])->data;

$result = $cryptopay->exchangeTransfers->commit($exchangeTransfer->id);
```

### Create an exchange transfer


```php
$params = [
  'charged_currency' => 'EUR',
  'charged_amount' => '100.0',
  'received_currency' => 'BTC',
  'received_amount' => null,
  'force_commit' => true
];

$result = $cryptopay->exchangeTransfers->create($params);
```

### Retrieve an exchange transfer


```php
$exchangeTransferId = '2c090f99-7cc1-40da-9bca-7caa57b4ebfb';

$result = $cryptopay->exchangeTransfers->retrieve($exchangeTransferId);
```

## Invoices

An invoice is a request for a cryptocurrency payment which contains a unique BTC, LTC, ETH or XRP address and the amount that has to be paid while the invoice is valid.

[Invoices API docs](https://developers.cryptopay.me/guides/invoices)

### List invoices


```php
$result = $cryptopay->invoices->all();
```

### Commit invoice recalculation


```php
$invoiceId = '8dd53e0f-0725-48b4-b0a7-1840aa67b5bb';
$recalculation = $cryptopay->invoices->createRecalculation($invoiceId)->data;

$result = $cryptopay->invoices->commitRecalculation($invoiceId, $recalculation->id);
```

### Create an invoice


```php
$params = [
  'price_amount' => '100.0',
  'price_currency' => 'EUR',
  'pay_currency' => 'BTC'
];

$result = $cryptopay->invoices->create($params);
```

### Create invoice recalculation


```php
$invoiceId = '29a563ad-b417-445c-b8f6-b6c806bb039b';
$params = ['force_commit' => true];

$result = $cryptopay->invoices->createRecalculation($invoiceId, $params);
```

### Create invoice refund


```php
$invoiceId = '331646a6-c8b5-430d-adfb-021d11ff6cd0';
$params = ['address' => '0xf3532c1fd002665ec54d46a50787e0c69c76cd44'];

$result = $cryptopay->invoices->createRefund($invoiceId, $params);
```

### List invoice refunds


```php
$invoiceId = '7e274430-e20f-4321-8748-20824287ae44';

$result = $cryptopay->invoices->allRefunds($invoiceId);
```

### Retrieve an invoice


```php
$invoiceId = 'c8233d57-78c8-4c36-b35e-940ae9067c78';

$result = $cryptopay->invoices->retrieve($invoiceId);
```

### Retrieve an invoice by custom_id


```php
$customId = 'PAYMENT-123';

$result = $cryptopay->invoices->retrieveByCustomId($customId);
```

## Rates


### Retrieve all rates


```php
$result = $cryptopay->rates->all();
```

### Retrieve a pair rate


```php
$result = $cryptopay->rates->retrieve('BTC', 'EUR');
```

## Risks

[Risks API docs](https://developers.cryptopay.me/guides/risks)

### Score a coin address


```php
$params = [
  'address' => '2N9wPGx67zdSeAbXi15qHgoZ9Hb9Uxhd2uQ',
  'currency' => 'BTC',
  'type' => 'source_of_funds'
];

$result = $cryptopay->risks->score($params);
```

## Transactions

[Transactions API docs](https://developers.cryptopay.me/guides/transactions)

### List transactions


```php
$result = $cryptopay->transactions->all();
```


# Callbacks

[Documentation](https://developers.cryptopay.me/guides/api-basics/callbacks)

All callbacks needs to be validated with [signature](https://developers.cryptopay.me/guides/api-basics/authentication/signature)

```php

<?php

// Get CallbackJson
$callbackJson = file_get_contents('php://input');

// Get headers
$headers = getallheaders();

$cryptopay->validateCallback($callbackJson, $headers);
```

If the signature is wrong, the package validation will throw ForbiddenException. Otherwise, it will return object.
