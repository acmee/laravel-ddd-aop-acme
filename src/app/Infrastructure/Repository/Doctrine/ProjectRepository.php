<?php

namespace Acme\Infrastructure\Repository\Doctrine;

use Illuminate\Support\Collection;

/**
 * Class ProjectRepository
 *
 * @package Acme\Infrastructure\Repository\Doctrine
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/05/07
 */
class ProjectRepository extends ARepository
{
    /**
     * @param string $name
     *
     * @return \Illuminate\Support\Collection
     * @throws \UnexpectedValueException
     */
    public function findByName(string $name) : Collection
    {
        return new Collection($this->repository()->findBy(['name' => $name]));
    }
}
