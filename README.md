# Force 2FA using a middleware

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cloudmazing/filament-force-2fa.svg?style=flat-square)](https://packagist.org/packages/cloudmazing/filament-force-2fa)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/cloudmazing/filament-force-2fa/run-tests?label=tests)](https://github.com/cloudmazing/filament-force-2fa/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/cloudmazing/filament-force-2fa/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/cloudmazing/filament-force-2fa/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/cloudmazing/filament-force-2fa.svg?style=flat-square)](https://packagist.org/packages/cloudmazing/filament-force-2fa)

# Usage

The package exposes a middleware that forces the user to have 2FA enabled. If the user don't, they are redirected to the filament 2FA settings page (based on [webbingbrasil/filament-2fa](https://github.com/webbingbrasil/filament-2fa)).

You can add the middleware to a middleware group (such as filament's `auth` group in `config/filament.php` which will *always* affect logged-in users).
```php
    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | You may customise the middleware stack that Filament uses to handle
    | requests.
    |
    */

    'middleware' => [
        'auth' => [
            // ...
            \CloudMazing\FilamentForce2FA\Http\Middleware\Require2FA::class,
        ],
        'base' => [
            //...
        ],
    ],
```

Or you can use the middleware on individual endpoints by registering in the Kernel `App\Http\Kernel`:

```php
    protected $routeMiddleware = [
        //...
        '2fa' => \CloudMazing\FilamentForce2FA\Http\Middleware\Require2FA::class,
    ];
```

Then when declaring routes:

```php
Route::middleware('2fa')->get('/hello');
```

## Installation

You can install the package via composer:

```bash
composer require cloudmazing/filament-force-2fa
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-force-2fa-migrations"
php artisan migrate
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [CloudMazing](https://github.com/WH-CloudMazing)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
