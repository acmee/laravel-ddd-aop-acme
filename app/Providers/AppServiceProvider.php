<?php

namespace Acme\Providers;

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
        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }

        $this->app->register(TwigBridgeServiceProvider::class);
        $this->app->alias('Twig', Twig::class);
    }

    protected function registerViewNamespaces() : void
    {
        $this->app['view']->addNamespace('web', base_path() . '/resources/web/views');
    }
}
