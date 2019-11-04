<?php

namespace Tests\Integration;

use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;
use Tests\TestCase;

/**
 * Class ServiceProviderTest
 *
 * @package     Tests\Integration
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class ServiceProviderTest extends TestCase
{
    /**
     * Test make log driver
     *
     * @return void
     */
    public function testItShouldProvidesLogDriver()
    {
        config()->set('logging.channels.custom', [
            'driver' => 'logzio',
            'name'   => 'channel-name',
            'token'  => 'logz-access-token',
            'type'   => 'https-bulk',
            'ssl'    => true,
            'level'  => 'info',
            'bubble' => true,
        ]);

        $logger = Log::channel('custom');

        $this->assertInstanceOf(LoggerInterface::class, $logger);
        // TODO: add more tests
    }
}
