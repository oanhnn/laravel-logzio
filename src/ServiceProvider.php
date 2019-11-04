<?php

namespace Laravel\Logzio;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Laravel\Logzio\Log\Handler;
use Monolog\Logger;

class ServiceProvider extends IlluminateServiceProvider
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
            $handler = new Handler(
                $config['token'],
                $config['type'] ?? 'http-bulk',
                $config['ssl'] ?? true,
                $config['level'] ?? Logger::WARNING,
                $config['bubble'] ?? true
            );
            return new Logger($config['name'], [$handler]);
        });
    }
}
