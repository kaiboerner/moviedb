<?php

namespace KaiBoerner\MovieDb\Entity;

use Doctrine\ORM\Mapping as ORM;
use KaiBoerner\MovieDb\Security\UserInterface;

/**
 * Users
 */
#[ORM\Table(name: "user")]
#[ORM\Entity]
class User implements UserInterface
{
    #[ORM\Column(name: "id", type: "integer", nullable: false, options: array("unsigned" => true))]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private ?int $id;

    #[ORM\Column(name: "name", type: "string", length: 63, nullable: false)]
    private string $name = '';

    #[ORM\Column(name: "password", type: "string", length: 255, nullable: false)]
    private string $password = '';


    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function equals(UserInterface $other): bool
    {
        return $this->name == $other->getName();
    }
}
