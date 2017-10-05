<?php

namespace Acme\Domain\Entity;

use Acme\Domain\Entity\Concerns;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ProjectOwner
 *
 * @package Acme\Domain\Entity
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 03.10.17
 */
class ProjectOwner
{
    use Concerns\Timestamps;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $surname;

    /**
     * @var string
     */
    protected $forename;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $projects;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
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
    public function getForename(): ?string
    {
        return $this->forename;
    }

    /**
     * @param string $forename
     *
     * @return void
     */
    public function setForename(string $forename): void
    {
        $this->forename = $forename;
    }

    /**
     * @return null|string
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     *
     * @return void
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @param \Acme\Domain\Entity\Project $project
     *
     * @return void
     */
    public function addProject(Project $project): void
    {
        if ($this->projects->contains($project)) {
            return;
        }

        $this->projects->add($project);
        $project->addProjectOwner($this);
    }

    /**
     * @param \Acme\Domain\Entity\Project $project
     *
     * @return void
     */
    public function removeProject(Project $project): void
    {
        if (!$this->projects->contains($project)) {
            return;
        }

        $this->projects->removeElement($project);
        $project->removeProjectOwner($this);
    }
}
