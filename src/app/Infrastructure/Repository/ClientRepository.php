<?php

namespace Acme\Infrastructure\Repository;

use Acme\Domain\Contract\ClientRepository as Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

/**
 * Class ClientRepository
 *
 * @package Acme\Infrastructure\Repository
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/09/27
 */
class ClientRepository extends EntityRepository implements Repository
{
    /**
     * @param string $name
     *
     * @return \Acme\Domain\Entity\Client[]|\Doctrine\Common\Collections\ArrayCollection
     */
    public function findByName(string $name): ArrayCollection
    {
        return new ArrayCollection($this->findBy(['name' => $name]));
    }

    /**
     * @return \Acme\Domain\Entity\Client[]|\Doctrine\Common\Collections\ArrayCollection
     */
    public function findAll(): ArrayCollection
    {
        $items = parent::findAll();

        return new ArrayCollection($items);
    }
}
