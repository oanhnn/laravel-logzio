<?php

namespace Tests\Unit;

use DateTime;
use Laravel\Logzio\Log\Formatter;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

class LogzioFormatterTest extends TestCase
{
    /**
     * Test it may be created with/without parameters
     *
     * @return void
     */
    public function testItBeConstructed()
    {
        // Case default parameters
        $formatter = new Formatter();

        $this->assertEquals(Formatter::BATCH_MODE_NEWLINES, $formatter->getBatchMode());
        $this->assertEquals(true, $formatter->isAppendingNewlines());

        // Case custom parameters
        $formatter = new Formatter(Formatter::BATCH_MODE_JSON, false);

        $this->assertEquals(Formatter::BATCH_MODE_JSON, $formatter->getBatchMode());
        $this->assertEquals(false, $formatter->isAppendingNewlines());
    }

    /**
     * Test it should format log record
     *
     * @return void
     */
    public function testItShouldFormatLog()
    {
        $formatter = new Formatter();
        $record = $this->getRecord();
        $formatted = json_decode($formatter->format($record), true);

        $this->assertArrayHasKey('@timestamp', $formatted);
        $this->assertArrayNotHasKey('datetime', $formatted);
    }

    /**
     * The simple log recore
     *
     * @return array
     */
    protected function getRecord($level = Logger::WARNING, $message = 'test', $context = []): array
    {
        return [
            'message' => $message,
            'context' => $context,
            'level' => $level,
            'level_name' => Logger::getLevelName($level),
            'channel' => 'test',
            'datetime' => DateTime::createFromFormat('U.u', sprintf('%.6F', microtime(true))),
            'extra' => [],
        ];
    }
}
