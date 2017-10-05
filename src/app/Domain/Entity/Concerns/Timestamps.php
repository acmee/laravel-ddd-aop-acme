<?php

namespace Acme\Domain\Entity\Concerns;

/**
 * Trait Timestamps
 *
 * @package Acme\Domain\Entity\Concerns
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/10/03
 */
trait Timestamps
{
    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * Set createdAt attribute only on insert.
     *
     * @return void
     */
    public function onPrePersist(): void
    {
        $this->setCreatedAt(new \DateTime('now'));
    }

    /**
     * Set updatedAt attribute every time on update.
     *
     * @return void
     */
    public function onPreUpdate(): void
    {
        $this->setUpdatedAt(new \DateTime('now'));
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return void
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     *
     * @return void
     */
    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
