<?php

namespace Laravel\Logzio\Log;

use Illuminate\Support\Arr;
use LogicException;
use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\Curl\Util;
use Monolog\Logger;

/**
 * Class Handler
 *
 * @package     Laravel\Logzio\Log
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT license
 *
 * @see    https://support.logz.io/hc/en-us/categories/201158705-Log-Shipping
 * @see    https://app.logz.io/#/dashboard/data-sources/Bulk-HTTPS
 */
final class Handler extends AbstractProcessingHandler
{
    /**
     * @var string
     */
    private $endpoint;

    /**
     * @param  string $level   The minimum logging level to trigger this handler.
     * @param  bool   $bubble  Whether or not messages that are handled should bubble up the stack.
     * @param  array  $options Logz.io client options
     * @throws \LogicException If curl extension is not available.
     */
    public function __construct(string $level = Logger::DEBUG, bool $bubble = true, array $options = [])
    {
        if (!extension_loaded('curl')) {
            throw new LogicException('The curl extension is needed to use the LogzIoHandler');
        }

        $this->endpoint = $this->buildEndpoint($options);

        parent::__construct($level, $bubble);
    }

    /**
     * {@inheritdoc}
     */
    public function handleBatch(array $records)
    {
        $level = $this->level;
        $records = array_filter(
            $records,
            function (array $record) use ($level): bool {
                return ($record['level'] >= $level);
            }
        );
        if ($records) {
            $this->send($this->getFormatter()->formatBatch($records));
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $record)
    {
        $this->send($record['formatted']);
    }

    /**
     * Send logging data to server
     *
     * @param mixed $data
     * @return void
     */
    protected function send($data)
    {
        $headers = ['Content-Type: application/json'];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->endpoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        Util::execute($ch, 3);
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultFormatter(): FormatterInterface
    {
        return new Formatter();
    }

    /**
     * Build listener endpoint
     *
     * @param  array $options
     * @return string
     */
    protected function buildEndpoint(array $options = []): string
    {
        $region = Arr::pull($options, 'region', '');
        $useSsl = Arr::pull($options, 'ssl', true);

        $endpoint = sprintf(
            '%s://listener%s.logz.io:%d',
            $useSsl ? 'https' : 'http',
            $this->validRegion($region) ? "-$region" : '',
            $useSsl ? 8071 : 8070
        );

        $endpoint .= '?' . http_build_query($options);

        return $endpoint;
    }

    /**
     * Validate region
     *
     * @param  string $region
     * @return bool
     */
    protected function validRegion(string $region): bool
    {
        return in_array($region, [
            'au', // Asia Pacific (Sydney) AWS
            'ca', // Canada (Central) AWS
            'eu', // Europe (Frankfurt) AWS
            'nl', // West Europe (Netherlands) Azure
            'wa', // West US 2 (Washington) Azure
        ]);
    }
}
