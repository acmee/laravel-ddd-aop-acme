<?php

namespace Acme\Domain\Entity;

use Acme\Domain\Entity\Concerns;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Project
 *
 * @package Acme\Domain\Entity
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/05/07
 */
class Project
{
    use Concerns\Timestamps;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $projectOwners;

    public function __construct()
    {
        $this->projectOwners = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     *
     * @return void
     */
    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
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

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param \Acme\Domain\Entity\ProjectOwner $projectOwner
     *
     * @return void
     */
    public function addProjectOwner(ProjectOwner $projectOwner): void
    {
        if ($this->projectOwners->contains($projectOwner)) {
            return;
        }

        $this->projectOwners->add($projectOwner);
        $projectOwner->addProject($this);
    }

    /**
     * @param \Acme\Domain\Entity\ProjectOwner $projectOwner
     *
     * @return void
     */
    public function removeProjectOwner(ProjectOwner $projectOwner): void
    {
        if (!$this->projectOwners->contains($projectOwner)) {
            return;
        }

        $this->projectOwners->removeElement($projectOwner);
        $projectOwner->removeProject($this);
    }
}
