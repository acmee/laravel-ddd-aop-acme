<?php

namespace Acme\Providers;

use Acme\Services\Log\LoggerServiceProvider;
use Illuminate\Support\ServiceProvider;
use TwigBridge\Facade\Twig;
use TwigBridge\ServiceProvider as TwigBridgeServiceProvider;

/**
 * Class RouteServiceProvider
 *
 * @package Acme\Providers
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/05/09
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() : void
    {
        $this->registerViewNamespaces();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() : void
    {
        $this->app->register(LoggerServiceProvider::class);

        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }

        $this->app->register(TwigBridgeServiceProvider::class);
        $this->app->alias('Twig', Twig::class);

        $this->app->registerDeferredProvider(RepositoryServiceProvider::class);
    }

    protected function registerViewNamespaces() : void
    {
        $this->app['view']->addNamespace('web', base_path() . '/resources/views/web');
    }
}
