<?php

namespace Laravel\Logzio;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Monolog\Logger;

class LogzioServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Log::extend('logzio', function ($app, array $config) {
            $handler = new LogzioHandler(
                $config['token'],
                $config['type'] ?? 'http-bulk',
                $config['ssl'] ?? true,
                $config['level'] ?? Logger::WARNING,
                $config['bubble'] ?? true,
                $config['region'] ?? '' // https://docs.logz.io/user-guide/accounts/account-region.html
            );
            return new Logger($config['name'], [$handler]);
        });
    }
}
