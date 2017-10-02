<?php

namespace Acme\Domain\Contract;

use Illuminate\Support\Collection;

/**
 * Interface Repository
 *
 * @package Acme\Domain\Contract
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/05/07
 */
interface Repository
{
    public function findAll(): Collection;
}
