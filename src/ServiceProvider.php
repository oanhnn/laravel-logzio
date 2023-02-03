<?php

namespace Laravel\Logzio;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Laravel\Logzio\Log\Handler;
use Monolog\Logger;

/**
 * Class Service Provider
 *
 * @package     oanhnn/laravel-logzio
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
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
            // $config = [
            //     'level' => Logger::WARNING,
            //     'bubble' => true,
            //     'token' => '...',
            //     'type' => 'http-bulk',
            //     'ssl' => true,
            //     'region' => '',
            //     'timestamp_format' => '',
            // ];
            $handler = new Handler(
                $config['level'] ?? 'warning',
                $config['bubble'] ?? true,
                $config
            );

            return new Logger($config['name'] ?? $app->environment(), [$handler]);
        });
    }
}
