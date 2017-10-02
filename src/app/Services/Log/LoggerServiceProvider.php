<?php

namespace Acme\Services\Log;

use Illuminate\Container\Container;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

/**
 * Class LoggerServiceProvider
 *
 * @package Acme\Services\Log
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 05/25/2017
 */
class LoggerServiceProvider extends ServiceProvider
{
    protected const ABSTRACT_LOGGER = 'logger';

    /**
     * @return void
     */
    public function boot(): void
    {
        $source = \config_path('logger.php');
        $this->mergeConfigFrom($source, static::ABSTRACT_LOGGER);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(static::ABSTRACT_LOGGER, function (Container $app) {
            $loggers = [];
            foreach ($app->config->get(static::ABSTRACT_LOGGER . '.loggers', []) as $logger => $levels) {
                $loggers[] = new LevelLogger($app->make($logger), (array)$levels);
            }

            return new LoggerContainer($loggers);
        });

        $this->app->alias(static::ABSTRACT_LOGGER, LoggerContainer::class);
        $this->app->alias(static::ABSTRACT_LOGGER, LoggerInterface::class);
        $this->app->alias(static::ABSTRACT_LOGGER, Log::class);
    }
}
