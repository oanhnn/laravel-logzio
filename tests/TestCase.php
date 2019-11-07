<?php

namespace Tests;

use Laravel\Logzio\ServiceProvider;
use Orchestra\Testbench\TestCase as Testbench;

/**
 * Class TestCase
 *
 * @package     Tests
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
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
        // Define your environment setup.
    }

    /**
     * Get loading package service provider.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    public function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }
}
