<?php

namespace Laravel\Logzio\Tests;

use Laravel\Logzio\LogzioServiceProvider;
use Orchestra\Testbench\TestCase as Testbench;

class TestCase extends Testbench
{
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Set user model
        $app['config']->set('session.driver', 'array');
    }

    /**
     * Get Laraplans package service provider.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    public function getPackageProviders($app)
    {
        return [
            LogzioServiceProvider::class,
        ];
    }
}
