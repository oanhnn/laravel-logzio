<?php

namespace Laravel\Logzio;

use Illuminate\Support\Arr;
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
            // $config = [
            //     'level' => Logger::WARNING,
            //     'bubble' => true,
            //     'token' => '...',
            //     'type' => 'http-bulk',
            //     'ssl' => true,
            //     'region' => '',
            // ];
            $handler = new Handler(
                Arr::pull($config, 'level', Logger::WARNING),
                Arr::pull($config, 'bubble', true),
                $config
            );

            return new Logger($config['name'], [$handler]);
        });
    }
}
