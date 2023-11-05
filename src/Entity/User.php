<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    // Getters y Setters
    
    public function setId($id): void
    {
        $this->id = (int) $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name): void
    {
        $this->name = (string) $name;
    }

    public function getName()
    {
        return $this->name;
    }
}
