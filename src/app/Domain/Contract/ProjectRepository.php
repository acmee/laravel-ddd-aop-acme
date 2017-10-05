<?php

namespace Acme\Domain\Contract;


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
     * @return mixed
     */
    public function findByName(string $name);
}
