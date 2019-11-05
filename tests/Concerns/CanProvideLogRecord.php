<?php

namespace Tests\Concerns;

use DateTime;
use Monolog\Logger;

trait CanProvideLogRecord
{
    /**
     * Make a simple log record
     *
     * @param  int|string $level   The log level
     * @param  string     $message The log message
     * @param  array      $context The log context
     * @return array
     */
    protected function logRecord($level = Logger::WARNING, $message = 'test', $context = []): array
    {
        $level = Logger::toMonologLevel($level);

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
