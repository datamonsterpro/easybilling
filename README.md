# EasyBilling Pro Client

Official PHP client library for the [EasyBilling Pro](https://easybilling.pro) API.

[![PHP Version](https://img.shields.io/badge/php-%3E%3D7.4-blue.svg)](https://php.net)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)

## Requirements

- PHP >= 7.4
- ext-json
- ext-curl

## Installation

```bash
composer require easybilling/pro-client
```

## Quick Start

```php
<?php

use EasyBilling\ProClient\EasyBillingClient;

$client = new EasyBillingClient('your-api-key');

// List invoices
$invoices = $client->invoices()->list(['status' => 'unpaid']);

foreach ($invoices as $invoice) {
    echo $invoice->getNumber() . ' — ' . $invoice->getTotal() . ' ' . $invoice->getCurrency() . PHP_EOL;
}

// Create an invoice
$invoice = $client->invoices()->create([
    'client_id' => 7,
    'currency'  => 'EUR',
    'due_date'  => '2025-12-31',
    'items'     => [
        ['description' => 'Web development', 'quantity' => 1, 'price' => 2500.00],
    ],
]);

echo 'Created invoice: ' . $invoice->getNumber();

// Mark as paid
$client->invoices()->markAsPaid($invoice->getId());
```

## API Reference

### Invoices

```php
$client->invoices()->list(array $filters = [])     // List invoices
$client->invoices()->get(int $id)                   // Get single invoice
$client->invoices()->create(array $payload)         // Create invoice
$client->invoices()->update(int $id, array $data)   // Update invoice
$client->invoices()->delete(int $id)                // Delete invoice
$client->invoices()->markAsSent(int $id)            // Mark as sent
$client->invoices()->markAsPaid(int $id)            // Mark as paid
```

### Clients

```php
$client->clients()->list(array $filters = [])     // List clients
$client->clients()->get(int $id)                   // Get single client
$client->clients()->create(array $payload)         // Create client
$client->clients()->update(int $id, array $data)   // Update client
$client->clients()->delete(int $id)                // Delete client
```

### Payments

```php
$client->payments()->list(array $filters = [])     // List payments
$client->payments()->get(int $id)                   // Get single payment
$client->payments()->create(array $payload)         // Record a payment
```

## Exception Handling

```php
use EasyBilling\ProClient\Exceptions\ApiException;
use EasyBilling\ProClient\Exceptions\AuthenticationException;
use EasyBilling\ProClient\Exceptions\RateLimitException;
use EasyBilling\ProClient\Exceptions\NetworkException;

try {
    $invoice = $client->invoices()->get(999);
} catch (AuthenticationException $e) {
    // Invalid API key (401)
} catch (RateLimitException $e) {
    // Too many requests (429)
} catch (NetworkException $e) {
    // Connection issues
} catch (ApiException $e) {
    // Other API errors
    echo $e->getMessage() . ' (HTTP ' . $e->getCode() . ')';
}
```

## Running Tests

```bash
composer install
composer test
```

## License

MIT — see [LICENSE](LICENSE) for details.
