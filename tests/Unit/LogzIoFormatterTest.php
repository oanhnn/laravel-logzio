<?php

namespace Tests\Unit;

use Laravel\Logzio\Log\Formatter;
use PHPUnit\Framework\TestCase;
use Tests\Concerns\CanProvideLogRecord;

/**
 * Class LogzioFormatterTest
 *
 * @package     Tests\Unit
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class LogzioFormatterTest extends TestCase
{
    use CanProvideLogRecord;

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
     * Test it should format a log record
     *
     * @return void
     */
    public function testItShouldFormatLog()
    {
        $formatter = new Formatter();
        $record = $this->logRecord();
        $formatted = json_decode($formatter->format($record), true);

        $this->assertArrayHasKey('@timestamp', $formatted);
        $this->assertArrayNotHasKey('datetime', $formatted);
    }
}
