# Mitrapayment Laravel SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/craftcodex/mpi-php-sdk.svg?style=flat-square)](https://packagist.org/packages/craftcodex/mpi-php-sdk)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/craftcodex/mpi-php-sdk/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/craftcodex/mpi-php-sdk/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/craftcodex/mpi-php-sdk/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/craftcodex/mpi-php-sdk/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/craftcodex/mpi-php-sdk.svg?style=flat-square)](https://packagist.org/packages/craftcodex/mpi-php-sdk)

The MitraPayment PHP SDK for Laravel is a software development kit that allows developers to easily integrate
MitraPayment's payment gateway services into Laravel web applications. It provides a set of pre-built functions and
classes that can be used to handle payment transactions, subscriptions, refunds, and other related tasks.

This package was build based on these documentation : [https://docs-api.mitrapayment.com/](https://docs-api.mitrapayment.com/)

## Installation

You can install the package via composer:

```bash
composer require craftcodex/mpi-php-sdk
```

You can publish and run the migrations with:

You can publish the config file with:

```bash
php artisan vendor:publish --tag="mpi-php-sdk-config"
```

This is the contents of the published config file:

```php
return [
    'credential' => [
        'key' => env('MPI_KEY'),
        'token' => env('MPI_TOKEN'),
    ],
    'callback_url' => env('MPI_CALLBACK_URL'),
];
```

## Usage

### Virtual Account

```php
use CraftCodex\MpiPhpSdk\Services\VirtualAccount;

VirtualAccount::make('va_bca')
                ->referencePrefix('PAYMENT-')
                ->callbackUrl(url('callback/va'))
                ->expiredIn(minutes: 10)
                ->displayName('Display Name')
                ->amount(1000000)
                ->send();

if ($request->successful()) {
    $response = $request->json();

    if ($response['success'] && @$response['data_payment']['status'] == 'pending') {
        // successfull response
        return;
    }

    if ($response['error_code']) {
        // Error response
        return;
    }
}
```

Available Method

| Method            | Description                                                                                                                                                                                            |
|-------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| referencePrefix   | We will generate the referenceId for you, you just have to put your prefix in this method. like an example if you set  `Deposit` as the prefix we will generate the referenceId as `Deposit-XXXXXXXXX` |
| callbackUrl       | Override default callback                                                                                                                                                                              |
| expiredIn         | Virtual account expiration time in minutes                                                                                                                                                             |
| displayName       | Display name for virtual account                                                                                                                                                                       |
| amount            | Amount the user should paid for (min: 10,000 IDR)                                                                                                                                                      |
| oneOffRequest     | (Default) the SDK automatically set the request type into oneOff which means this virtual account will be closed everytime the bill has been paid                                                      |
| persistentRequest | This is the opposite of oneOff request, the virtual account can be topped up multiple times and will be closed depending on the expiration time                                                        |
| send              | Sending the request                                                                                                                                                                                    |

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Franky So](https://github.com/craftcodex)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
