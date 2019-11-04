<?php

namespace Laravel\Logzio\Log;

use DateTimeInterface;
use Monolog\Formatter\JsonFormatter;

/**
 * Class Formatter
 *
 * @package     Laravel\Logzio\Log
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class Formatter extends JsonFormatter
{
    /**
     * Datetime format for Logz.io
     * @see https://support.logz.io/hc/en-us/articles/210206885
     */
    const DATETIME_FORMAT = 'c';

    /**
     * @param int $batchMode
     * @param bool $appendNewline
     */
    public function __construct(int $batchMode = self::BATCH_MODE_NEWLINES, bool $appendNewline = true)
    {
        parent::__construct($batchMode, $appendNewline);
    }

    /**
     * Appends the '@timestamp' parameter for Logz.io.
     *
     * @param array $record
     * @return string
     */
    public function format(array $record): string
    {
        if (isset($record["datetime"]) && ($record["datetime"] instanceof DateTimeInterface)) {
            $record["@timestamp"] = $record["datetime"]->format(self::DATETIME_FORMAT);

            unset($record["datetime"]);
        }

        return parent::format($record);
    }
}
