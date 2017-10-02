<?php

namespace Acme\Services\Log;

use Illuminate\Contracts\Logging\Log;
use Psr\Log\LoggerInterface;

/**
 * Class LoggerContainer
 *
 * @package Acme\Services\Log
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 05/25/2017
 */
class LoggerContainer implements Log, LoggerInterface
{
    use LoggerTrait;

    /**
     * @var \Illuminate\Contracts\Logging\Log[]
     */
    protected $loggers;

    /**
     * @param \Illuminate\Contracts\Logging\Log[] $loggers
     */
    public function __construct(array $loggers)
    {
        $this->loggers = $loggers;
    }

    /**
     * @param $level
     * @param $message
     * @param array $context
     *
     * @return void
     */
    public function log($level, $message, array $context = []): void
    {
        foreach ($this->loggers as $logger) {
            $logger->log($level, $this->formatMessage($message), $context);
        }
    }

    /**
     * @param string $path
     * @param string $level
     *
     * @return void
     */
    public function useFiles($path, $level = 'debug'): void
    {
        foreach ($this->loggers as $logger) {
            $logger->useFiles($path, $level);
        }
    }

    /**
     * @param string $path
     * @param int $days
     * @param string $level
     *
     * @return void
     */
    public function useDailyFiles($path, $days = 0, $level = 'debug'): void
    {
        foreach ($this->loggers as $logger) {
            $logger->useDailyFiles($path, $days, $level);
        }
    }
}
