<?php

namespace Acme\Infrastructure\Repository;

use Acme\Domain\Contract\ProjectRepository as Repository;
use Doctrine\ORM\EntityRepository;
use Illuminate\Support\Collection;

/**
 * Class ProjectRepository
 *
 * @package Acme\Infrastructure\Repository
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/09/27
 */
class ProjectRepository extends EntityRepository implements Repository
{
    /**
     * @param string $name
     *
     * @return \Acme\Domain\Entity\Project[]|\Illuminate\Support\Collection
     */
    public function findByName(string $name): Collection
    {
        return new Collection($this->findBy(['name' => $name]));
    }

    /**
     * @return \Acme\Domain\Entity\Project[]|\Illuminate\Support\Collection
     */
    public function findAll(): Collection
    {
        $items = parent::findAll();

        return new Collection($items);
    }
}
