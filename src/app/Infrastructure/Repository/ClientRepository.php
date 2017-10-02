<?php

namespace Acme\Infrastructure\Repository;

use Acme\Domain\Contract\ClientRepository as RepositoryContract;
use Doctrine\ORM\EntityRepository;
use Illuminate\Support\Collection;

/**
 * Class ClientRepository
 *
 * @package Acme\Infrastructure\Repository
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/09/27
 */
class ClientRepository extends EntityRepository implements RepositoryContract
{
    /**
     * @param string $name
     *
     * @return \Acme\Domain\Entity\Client[]|\Illuminate\Support\Collection
     */
    public function findByName(string $name): Collection
    {
        return new Collection($this->findBy(['name' => $name]));
    }

    /**
     * @return \Acme\Domain\Entity\Client[]|\Illuminate\Support\Collection
     */
    public function findAll(): Collection
    {
        $items = parent::findAll();

        return new Collection($items);
    }
}
