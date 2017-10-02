<?php

namespace Acme\Services\Log;

use Illuminate\Contracts\Logging\Log;
use Psr\Log\LoggerInterface;

/**
 * Class LevelLogger
 *
 * @package Acme\Services\Log
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 05/25/2017
 */
class LevelLogger implements Log, LoggerInterface
{
    use LoggerTrait;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var array
     */
    protected $levels;

    /**
     * @param \Psr\Log\LoggerInterface $logger
     * @param array $levels
     */
    public function __construct(LoggerInterface $logger, array $levels)
    {
        $this->logger = $logger;
        $this->levels = $levels;
    }

    /**
     * @param mixed|string $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log($level, $message, array $context = []): void
    {
        if ($this->shouldLog($level)) {
            $this->logger->log($level, $this->formatMessage($message), $context);
        }
    }

    /**
     * @param string $level
     *
     * @return bool
     */
    protected function shouldLog(string $level): bool
    {
        if ($this->levels === ['*'] || $this->levels === ['all']) {
            return true;
        }

        return \in_array($level, $this->levels, true);
    }

    /**
     * @param string $path
     * @param string $level
     *
     * @return void
     */
    public function useFiles($path, $level = 'debug'): void
    {
        if ($this->logger instanceof Log) {
            $this->logger->useFiles($path, $level);
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
        if ($this->logger instanceof Log) {
            $this->logger->useDailyFiles($path, $days, $level);
        }
    }
}
