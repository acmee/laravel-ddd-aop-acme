<?php

namespace Acme\Services\Log;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

/**
 * Trait LoggerTrait
 *
 * @package Acme\Services\Log
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 05/25/2017
 */
trait LoggerTrait
{
    /**
     * @param string $level
     * @param mixed $message
     * @param array $context
     *
     * @return void
     */
    abstract public function log($level, $message, array $context = []) : void;

    /**
     * @param mixed $message
     * @param array $context
     *
     * @return void
     */
    public function emergency($message, array $context = []) : void
    {
        $this->log('emergency', $message, $context);
    }

    /**
     * @param mixed $message
     * @param array $context
     *
     * @return void
     */
    public function alert($message, array $context = []) : void
    {
        $this->log('alert', $message, $context);
    }

    /**
     * @param mixed $message
     * @param array $context
     *
     * @return void
     */
    public function critical($message, array $context = []) : void
    {
        $this->log('critical', $message, $context);
    }

    /**
     * @param mixed $message
     * @param array $context
     *
     * @return void
     */
    public function error($message, array $context = []) : void
    {
        $this->log('error', $message, $context);
    }

    /**
     * @param mixed $message
     * @param array $context
     *
     * @return void
     */
    public function warning($message, array $context = []) : void
    {
        $this->log('warning', $message, $context);
    }

    /**
     * @param mixed $message
     * @param array $context
     *
     * @return void
     */
    public function notice($message, array $context = []) : void
    {
        $this->log('notice', $message, $context);
    }

    /**
     * @param mixed $message
     * @param array $context
     *
     * @return void
     */
    public function info($message, array $context = []) : void
    {
        $this->log('info', $message, $context);
    }

    /**
     * @param mixed $message
     * @param array $context
     *
     * @return void
     */
    public function debug($message, array $context = []) : void
    {
        $this->log('debug', $message, $context);
    }

    /**
     * @param mixed $message
     *
     * @return mixed
     */
    protected function formatMessage($message)
    {
        switch (true) {
            case \is_array($message):
                return \var_export($message, true);
            case ($message instanceOf Jsonable):
                return $message->toJson();
            case ($message instanceOf Arrayable):
                return \var_export($message->toArray(), true);
            default:
                return $message;
        }
    }
}
