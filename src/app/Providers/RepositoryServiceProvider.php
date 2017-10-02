<?php

namespace Acme\Providers;

use Acme\Domain\Contract\ProjectRepository;
use Acme\Domain\Contract\Repository;
use Acme\Domain\Entity;
use Acme\Domain\Contract\ClientRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\ORM\DoctrineServiceProvider;
use LaravelDoctrine\ORM\Facades as DoctrineFacade;

/**
 * Class RepositoryServiceProvider
 *
 * @package Acme\Providers
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/05/09
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->defer = true;

        parent::__construct($app);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->registerOrm(true);

        $this->app->bind(ProjectRepository::class, function ($app): Repository {
            return new \Acme\Infrastructure\Repository\ProjectRepository(
                $app['em'],
                $app['em']->getClassMetaData(Entity\Project::class)
            );
        });

        $this->app->bind(ClientRepository::class, function ($app): Repository {
            return new \Acme\Infrastructure\Repository\ClientRepository(
                $app['em'],
                $app['em']->getClassMetaData(Entity\Client::class)
            );
        });
    }

    /**
     * @param bool $useFacades
     *
     * @return void
     */
    protected function registerOrm($useFacades = false): void
    {
        $this->app->register(DoctrineServiceProvider::class);

        if (true === $useFacades) {
            $this->app->alias('EntityManager', DoctrineFacade\EntityManager::class);
            $this->app->alias('Registry', DoctrineFacade\Registry::class);
            $this->app->alias('Doctrine', DoctrineFacade\Doctrine::class);
        }
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return [
            ProjectRepository::class,
            ClientRepository::class
        ];
    }
}
