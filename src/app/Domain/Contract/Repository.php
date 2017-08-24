<?php

namespace Acme\Domain\Contract;

/**
 * Interface Repository
 *
 * @package Acme\Domain\Contract
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/05/07
 */
interface Repository
{
    /**
     * @param mixed $id
     *
     * @return mixed
     */
    public function find($id) : mixed;

    /**
     * @return mixed
     */
    public function findAll() : mixed;
}
