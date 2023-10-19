
# DirectAff PHP SDK Documentation

## Introduction

The DirectAff PHP SDK provides a simple interface to interact with the DirectAff API. This SDK offers methods to register, deposit, withdraw, manage bonuses, bet/win actions, and handle chargebacks.

## Installation

This package can be installed via Composer:

```bash
composer require directaff/php-sdk
```

## Configuration

Before making any API calls, ensure you set the base URL, secret API key, and brand ID:

```php
use DirectAff\DirectAff;
$directAff = new DirectAff();
$directAff->setBaseUrl('YOUR_API_BASE_URL')
          ->setSecretApiKey('YOUR_SECRET_API_KEY')
          ->setBrandId(YOUR_BRAND_ID);
```

## Methods

### Register

To register a user:

```php
$response = $directAff->register([
    'clickId' => 'exampleClickId',
    'username' => 'exampleUsername',
    'registration_date' => '2023-01-01 00:00:00'
]);
```

### Deposit

To record a deposit:

```php
$response = $directAff->deposit([
    'clickId' => 'exampleClickId',
    'amount' => 100,
    'currency' => 'USD',
    'depositId' => '12345',
    'transactionDate' => '2023-01-01 00:00:00'
]);
```

### Withdraw

To record a withdrawal:

```php
$response = $directAff->withdraw([
    'clickId' => 'exampleClickId',
    'currency' => 'USD',
    'withdrawId' => '12345',
    'transactionDate' => '2023-01-01 00:00:00'
]);
```
### Chargeback

To record a chargeback:

```php
$response = $directAff->chargeback([
    'clickId' => 'exampleClickId',
    'currency' => 'USD',
    'chargebackId' => '12345',
    'transactionDate' => '2023-01-01 00:00:00'
]);
```

### Bonus Added

To record a bonus added:

```php
$response = $directAff->bonusAdded([
    'clickId' => 'exampleClickId',
    'currency' => 'USD',
    'bonusId' => '12345',
    'transactionDate' => '2023-01-01 00:00:00'
]);
```

### Bonus Removed

To record a bonus removed:

```php
$response = $directAff->bonusRemoved([
    'clickId' => 'exampleClickId',
    'currency' => 'USD',
    'bonusId' => '12345',
    'transactionDate' => '2023-01-01 00:00:00'
]);
```

### Bet and Win

To record bet and win:

```php
$response = $directAff->betWin([
    'clickId' => 'exampleClickId',
    'currency' => 'USD',
    'betAmount' => '125.10',
    'winAmount' => '104.25'
]);
```

## Error Handling

Errors from the DirectAff API are returned as associative arrays with a `success` key set to `false` and an `error` key containing the error message.

For example:

```
[
    'success' => false,
    'error' => 'Click not found'
]
```
