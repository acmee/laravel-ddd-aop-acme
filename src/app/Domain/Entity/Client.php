<?php

namespace Acme\Domain\Entity;

use Acme\Domain\Entity\Concerns;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Client
 *
 * @package Acme\Domain\Entity
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/09/28
 */
class Client
{
    use Concerns\Timestamps;

    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @return \Ramsey\Uuid\UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
