<?php

namespace Acme\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Project
 *
 * @package Acme\Domain\Entity
 * @author Ulf Tiburtius <ulf@idea-works.de>
 * @since 2017/05/07
 *
 *
 * @ORM\Entity
 * @ORM\Table(name="projects")
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $name;

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return void
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }
}
