<?php

namespace Acme\Infrastructure\Repository;

use Acme\Domain\Contract\ProjectOwnerRepository as Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

/**
 * Class ProjectOwnerRepository
 *
 * @package Acme\Infrastructure\Repository
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/10/04
 */
class ProjectOwnerRepository extends EntityRepository implements Repository
{
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findAll(): ArrayCollection
    {
        $items = parent::findAll();

        return new ArrayCollection($items);
    }
}
