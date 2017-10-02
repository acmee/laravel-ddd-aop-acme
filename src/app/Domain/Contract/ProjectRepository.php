<?php

namespace Acme\Domain\Contract;

use Illuminate\Support\Collection;

/**
 * Interface ProjectRepository
 *
 * @package Acme\Domain\Contract
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/09/29
 */
interface ProjectRepository extends Repository
{
    /**
     * @param string $name
     *
     * @return \Acme\Domain\Entity\Project[]|\Illuminate\Support\Collection
     */
    public function findByName(string $name): Collection;
}
