<?php

namespace Laravel\Logzio\Tests\Unit;

use Laravel\Logzio\LogzioFormatter;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

class LogzioFormatterTest extends TestCase
{
    /**
     * @covers \Laravel\Logzio\LogzioFormatter::__construct()
     */
    public function testConstruct()
    {
        // Case default parameters
        $formatter = new LogzioFormatter();

        $this->assertEquals(LogzioFormatter::BATCH_MODE_NEWLINES, $formatter->getBatchMode());
        $this->assertEquals(true, $formatter->isAppendingNewlines());

        // Case custom parameters
        $formatter = new LogzioFormatter(LogzioFormatter::BATCH_MODE_JSON, false);

        $this->assertEquals(LogzioFormatter::BATCH_MODE_JSON, $formatter->getBatchMode());
        $this->assertEquals(false, $formatter->isAppendingNewlines());
    }

    /**
     * @covers \Laravel\Logzio\LogzioFormatter::format()
     */
    public function testFormat()
    {
        // Case default parameters
        $formatter = new LogzioFormatter();
        $record = $this->getRecord();
        $formatted_decoded = json_decode($formatter->format($record), true);

        static::assertArrayHasKey('@timestamp', $formatted_decoded);
        static::assertArrayNotHasKey('datetime', $formatted_decoded);

        // Case custom parameters
        $formatter = new LogzioFormatter(LogzioFormatter::BATCH_MODE_NEWLINES, false);
        $record = $this->getRecord();
        $formatted_decoded = json_decode($formatter->format($record), true);

        static::assertArrayHasKey('@timestamp', $formatted_decoded);
        static::assertArrayNotHasKey('datetime', $formatted_decoded);
    }

    /**
     * @return array Record
     */
    protected function getRecord($level = Logger::WARNING, $message = 'test', $context = [])
    {
        return [
            'message' => $message,
            'context' => $context,
            'level' => $level,
            'level_name' => Logger::getLevelName($level),
            'channel' => 'test',
            'datetime' => \DateTime::createFromFormat('U.u', sprintf('%.6F', microtime(true))),
            'extra' => [],
        ];
    }
}
