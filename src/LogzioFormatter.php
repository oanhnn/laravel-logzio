<?php

namespace Laravel\Logzio;

use Monolog\Formatter\JsonFormatter;

class LogzioFormatter extends JsonFormatter
{
    /**
     * Datetime format for Logz.io
     * @see https://support.logz.io/hc/en-us/articles/210206885-How-can-I-get-Logz-io-to-read-the-timestamp-within-a-JSON-log-
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
        if (isset($record["datetime"]) && ($record["datetime"] instanceof \DateTimeInterface)) {
            $record["@timestamp"] = $record["datetime"]->format(self::DATETIME_FORMAT);
            unset($record["datetime"]);
        }

        return parent::format($record);
    }
}
