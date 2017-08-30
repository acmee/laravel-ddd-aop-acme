<?php

namespace Acme\Providers;

use Acme\Infrastructure\Aspects\Logging\LoggingAspect;
use Go\Laravel\GoAopBridge\GoAopServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

/**
 * Class AopServiceProvider
 *
 * @package Acme\Providers
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 05/24/2017
 */
class AopServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    private $aopTag = 'goaop.aspect';

    /**
     * @return void
     */
    public function register() : void
    {
        $this->app->register(GoAopServiceProvider::class);

        $this->app->singleton(LoggingAspect::class, function (Application $app) {
            return new LoggingAspect($app->make(LoggerInterface::class));
        });

        $this->app->tag([LoggingAspect::class], $this->aopTag);
    }
}
