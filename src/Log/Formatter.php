<?php

namespace Laravel\Logzio\Log;

use DateTimeInterface;
use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\JsonFormatter;

/**
 * Class Formatter
 *
 * @package     oanhnn/laravel-logzio
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 */
class Formatter extends JsonFormatter implements FormatterInterface
{
    private $timestampFormat;

    /**
     * @param  int  $batchMode
     * @param  bool $appendNewline
     */
    public function __construct(string $timestampFormat, int $batchMode = self::BATCH_MODE_NEWLINES, bool $appendNewline = true)
    {
        parent::__construct($batchMode, $appendNewline);
        $this->timestampFormat = $timestampFormat;
    }

    /**
     * Appends the '@timestamp' parameter for Logz.io.
     *
     * @param  array  $record
     * @return string
     */
    public function format(array $record): string
    {
        if (isset($record["datetime"]) && ($record["datetime"] instanceof DateTimeInterface)) {
            $record["@timestamp"] = $record["datetime"]->format($this->timestampFormat);

            unset($record["datetime"]);
        }

        return parent::format($record);
    }
}
