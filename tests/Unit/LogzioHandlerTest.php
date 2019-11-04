<?php

namespace Tests\Unit;

use Laravel\Logzio\Log\Formatter;
use Laravel\Logzio\Log\Handler;
use LogicException;
use PHPUnit\Framework\TestCase;
use Tests\Concerns\NonPublicAccessible;

class LogzioHandlerTest extends TestCase
{
    use NonPublicAccessible;

    /**
     * Test it should throw exception when create handler without token parameter
     *
     * @return void
     */
    public function testItShouldThowExceptionWhenMissingTokenParameter()
    {
        $this->expectedException(LogicException::class);
        $this->expectedExceptionMessage('The token parameter is required to use the Logz.io Handler');

        new Handler('debug', true, ['ssl' => true]);
    }

    /**
     * Test it should build endpoint when create handler
     *
     * @param  string $expected
     * @param  array  $options
     * @return void
     * @dataProvider optionsForBuildEndpoint
     */
    public function testItShouldBuildEndpoint($expected, $options)
    {
        $handler = new Handler('debug', true, $options);
        $endpoint = $this->getNonPublicProperty($handler, 'endpoint');

        $this->assertIsString($endpoint);
        $this->assertSame($expected, $endpoint);
    }

    /**
     * Test it should providers default formatter
     *
     * @return void
     */
    public function testItShouldProvidersDefaultFormatter()
    {
        $handler = new Handler('debug', false, ['token' => 'abc']);
        $defaultFormatter = $handler->getFormatter();

        $this->assertInstanceOf(Formatter::class, $defaultFormatter);

        // Test default formatter be created with default parameters
        $this->assertTrue($defaultFormatter->isAppendingNewlines());
        $this->assertEquals(Formatter::BATCH_MODE_NEWLINES, $defaultFormatter->getBatchMode());
    }

    /**
     * The options for create handler and expected endpoint
     *
     * @return array
     */
    public function optionsForBuildEndpoint(): array
    {
        return [
            ['https://listener.logz.io:8071?token=abc', ['token' => 'abc']],
            ['https://listener.logz.io:8071?token=abc', ['token' => 'abc', 'ssl' => true]],
            ['http://listener.logz.io:8070?token=abc', ['token' => 'abc', 'ssl' => false]],
            ['https://listener-au.logz.io:8071?token=abc', ['token' => 'abc', 'region' => 'au']],
            ['https://listener.logz.io:8071?token=abc', ['token' => 'abc', 'region' => 'tw']],
            [
                'https://listener.logz.io:8071?token=abc&type=http-bulk',
                ['token' => 'abc', 'type' => 'http-bulk'],
            ],
            [
                'https://listener-eu.logz.io:8071?token=abc&type=http-bulk',
                ['token' => 'abc', 'type' => 'http-bulk', 'region' => 'eu'],
            ],
        ];
    }
}
