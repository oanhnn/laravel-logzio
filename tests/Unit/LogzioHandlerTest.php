<?php

namespace Tests\Unit;

use Laravel\Logzio\Log\Formatter;
use Laravel\Logzio\Log\Handler;
use PHPUnit\Framework\TestCase;

class LogzioHandlerTest extends TestCase
{
    /**
     * @covers \Laravel\Logzio\Log\Handler::getDefaultFormatter()
     */
    public function testItShouldProvidersDefaultFormatter()
    {
        $handler = new Handler('dumy');
        $defaultFormatter = $handler->getFormatter();

        $this->assertInstanceOf(Formatter::class, $defaultFormatter);

        // Test default formatter be created with default parameters
        $this->assertTrue($defaultFormatter->isAppendingNewlines());
        $this->assertEquals(Formatter::BATCH_MODE_NEWLINES, $defaultFormatter->getBatchMode());
    }
}
