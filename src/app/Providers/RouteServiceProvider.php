<?php

namespace Acme\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class RouteServiceProvider
 *
 * @package Acme\Providers
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/05/09
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $namespace = 'Acme\Http\Controllers';

    /**
     * @return void
     */
    public function boot() : void
    {
        parent::boot();
    }

    /**
     * @param Router $router
     *
     * @return void
     */
    public function map(Router $router) : void
    {
        //$this->mapApiRoutes();
        $this->mapWebRoutes($router);
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes(Router $router) : void
    {
        $router
            ->group([
                'namespace' => $this->namespace . '\Web',
                'middleware' => ['web']
            ],
            function (Router $router) : void {
                require_once base_path('routes/web.php');
            });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes() : void
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
