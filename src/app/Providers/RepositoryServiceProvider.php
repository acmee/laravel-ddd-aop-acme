<?php

namespace Acme\Providers;

use Acme\Domain\Contract\Repository;
use Acme\Domain\Entity;
use Acme\Infrastructure\Repository\Doctrine\ProjectRepository;
use Doctrine\ORM\EntityManager;
use Illuminate\Support\Collection;
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
     * @var bool
     */
    protected $defer = true;

    /**
     * @return void
     */
    public function register() : void
    {
        $this->registerOrm();

        $this->app->bind(ProjectRepository::class, function () : Repository {
            return new ProjectRepository(EntityManager::getRepository(Entity\Project::class), new Collection());
        });
    }

    /**
     * @param bool $useFacade
     *
     * @return void
     */
    protected function registerOrm($useFacade = false) : void
    {
        $this->app->register(DoctrineServiceProvider::class);

        if ($useFacade) {
            $this->app->alias('EntityManager', DoctrineFacade\EntityManager::class);
            $this->app->alias('Registry', DoctrineFacade\Registry::class);
            $this->app->alias('Doctrine', DoctrineFacade\Doctrine::class);
        }
    }

    /**
     * @return array
     */
    public function provides() : array
    {
        return [
            ProjectRepository::class
        ];
    }
}
