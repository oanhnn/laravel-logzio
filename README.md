# Introduction

[![Latest Version](https://img.shields.io/packagist/v/oanhnn/laravel-logzio.svg)](https://packagist.org/packages/oanhnn/laravel-logzio)
[![Software License](https://img.shields.io/github/license/oanhnn/laravel-logzio.svg)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/oanhnn/laravel-logzio/master.svg)](https://travis-ci.org/oanhnn/laravel-logzio)
[![Build Status](https://github.com/oanhnn/laravel-logzio/workflows/CI/badge.svg)](https://github.com/oanhnn/laravel-logzio/actions)
[![Coverage Status](https://img.shields.io/coveralls/github/oanhnn/laravel-logzio/master.svg)](https://coveralls.io/github/oanhnn/laravel-logzio?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/oanhnn/laravel-logzio.svg)](https://packagist.org/packages/oanhnn/laravel-logzio)
[![Requires PHP](https://img.shields.io/travis/php-v/oanhnn/laravel-logzio.svg)](https://travis-ci.org/oanhnn/laravel-logzio)

Easy integrate [Logz.io](https://logz.io) into PHP and [Laravel](https://laravel.com) 5.6+ Application

## Main features

- [x] Make Logz.io handler for [Monolog](https://packagist.org/packages/monolog/monolog)
- [x] Make `logzio` driver for integrate Logz.io into Laravel Application

## Requirements

* php >=7.1.3
* Laravel 5.6+ (when using with Laravel)

> Laravel 6.0+ required php 7.2+

## Installation

Begin by pulling in the package through Composer.

```bash
$ composer require oanhnn/laravel-logzio
```

## Usage

### PHP (non Laravel)

```php
<?php

use Laravel\Logzio\Log\Handler;
use Monolog\Logger;

$config = [
    'token' => '...',
    'type' => 'http-bulk',
    'ssl' => true,
    'region' => '',
];

$logger = new Logger('log-name');
$logger->pushHandler(new Handler(Logger::DEBUG, true, $config);

$logger->info('Some message');
```

### Laravel

In `config/logging.php` file, config you log with driver `logzio`

```php
<?php
return [
    // ...
	'custom' => [
	    'driver' => 'logzio',
	    'name'   => 'channel-name',
	    'token'  => 'logz-access-token',
	    'type'   => 'http-bulk',
	    'ssl'    => true,
	    'level'  => 'info',
	    'bubble' => true,
	    'region' => 'eu', // leave empty for default region
	],
	// ...
];

```

In your code using

```php
Log::channel('custom')->info('Some message');

```

See more in [Laravel document](https://laravel.com/docs/5.6/logging)

## Changelog

See all change logs in [CHANGELOG](CHANGELOG.md)

## Testing

```bash
$ git clone git@github.com/oanhnn/laravel-logzio.git /path
$ cd /path
$ composer install
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email to [Oanh Nguyen](mailto:oanhnn.bk@gmail.com) instead of 
using the issue tracker.

## Credits

- [Oanh Nguyen](https://github.com/oanhnn)
- [All Contributors](../../contributors)

## License

This project is released under the MIT License.   
Copyright © [Oanh Nguyen](https://oanhnn.github.io/).
