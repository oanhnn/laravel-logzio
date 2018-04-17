# Introduction

[![Build Status](https://travis-ci.org/oanhnn/laravel-flash-message.svg?branch=master)](https://travis-ci.org/oanhnn/laravel-flash-message)
[![Coverage Status](https://coveralls.io/repos/github/oanhnn/laravel-flash-message/badge.svg?branch=master)](https://coveralls.io/github/oanhnn/laravel-flash-message?branch=master)

Easy integrate [Logz.io](https://logz.io) into [Laravel](https://laravel.com) 5.6+ Application

## Main features

Make `logzio` driver for integrate Logz.io into Laravel Application

## Requirements

* php >=7.1.3
* Laravel 5.6+

## Installation

Begin by pulling in the package through Composer.

```bash
$ composer require oanhnn/laravel-logzio
```

## Usage

In `config/logging.php` file, config you log with driver `logzio`

```php
<?php
return [
    // ...
	'custom' => [
	    'driver' => 'logzio',
	    'name'   => 'channel-name',
	    'token'  => 'logz-access-token',
	    'type'   => 'https-bulk',
	    'ssl'    => true,
	    'level'  => 'info',
	    'bubble' => true,
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
$ composer phpunit
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
Copyright © 2018 [Oanh Nguyen](https://oanhnn.github.io/).
