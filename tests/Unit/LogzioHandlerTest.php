<?php

namespace Laravel\Logzio\Tests\Unit;

use Laravel\Logzio\LogzioFormatter;
use Laravel\Logzio\LogzioHandler;
use PHPUnit\Framework\TestCase;

class LogzioHandlerTest extends TestCase
{
    /**
     * @covers \Laravel\Logzio\LogzioHandler::getDefaultFormatter()
     */
    public function testGetDefaultFormatter()
    {
        $handler = new LogzioHandler('dumy');
        $defaultFormatter = $handler->getFormatter();

        static::assertTrue($defaultFormatter instanceof LogzioFormatter);
        static::assertTrue($defaultFormatter->isAppendingNewlines());
        static::assertSame(LogzioFormatter::BATCH_MODE_NEWLINES, $defaultFormatter->getBatchMode());
    }
}
