<?php

namespace KaiBoerner\MovieDb\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use KaiBoerner\MovieDb\Security\UserInterface;

/**
 * Movie
 */
 #[ORM\Table(name: "movie")]
 #[ORM\Entity]
class Movie implements HasCreatedBy
{
    #[ORM\Column(name: "id", type: "integer", nullable: false, options: array("unsigned" => true))]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private ?int $id = null;

    #[ORM\Column(name: "title", type: "string", length: 255, nullable: false)]
    private string $title = '';

    #[ORM\Column(name: "regisseur", type: "string", length: 127, nullable: false)]
    private string $regisseur = '';

    #[ORM\Column(name: "publication", type: "date_immutable", nullable: false)]
    private ?\DateTimeImmutable $publication = null;

    #[ORM\Column(name: "created", type: "datetime_immutable", nullable: false)]
    private \DateTimeImmutable $created;

    #[ORM\ManyToOne(targetEntity: "KaiBoerner\MovieDb\Entity\User")]
    #[ORM\JoinColumn(name: "created_by", referencedColumnName: "id")]
    private ?User $createdBy = null;


    public function __construct()
    {
        $this->created = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getRegisseur(): string
    {
        return $this->regisseur;
    }

    public function setRegisseur(string $regisseur): self
    {
        $this->regisseur = $regisseur;

        return $this;
    }

    public function getPublication(): ?\DateTimeImmutable
    {
        return $this->publication;
    }

    public function setPublication(\DateTimeImmutable $publication): self
    {
        $this->publication = $publication;

        return $this;
    }

    public function getCreated(): \DateTimeImmutable
    {
        return $this->created;
    }

    public function getCreatedBy(): ?UserInterface
    {
        return $this->createdBy;
    }

    public function setCreatedBy(UserInterface $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    // additional

    public function acceptFormData(array $data): self
    {
        foreach ($data as $i => $v) {
            switch ($i) {
                case 'title':
                    $this->setTitle($v);
                    break;

                case 'publication':
                    $this->setPublication(new \DateTimeImmutable($v));
                    break;

                case 'regisseur':
                    $this->setRegisseur($v);
                    break;
            }
        }

        return $this;
    }

    public function isDeleteAllowed(UserInterface $user): bool
    {
        return $this->isEditAllowed($user);
    }

    public function isEditAllowed(UserInterface $user): bool
    {
        return null === $this->createdBy || $this->createdBy->equals($user);
    }

    public function isUnique(EntityManagerInterface $entityManager): bool
    {
        $existing = $entityManager
            ->getRepository(self::class)
            ->findOneBy(['title' => $this->title])
        ;

        return empty($existing) || $existing->id === $this->id;
    }

    public function isValid(): bool
    {
        return !empty($this->title)
            && !empty($this->regisseur)
            && !empty($this->publication)
            && mb_strlen($this->title) <= 255
            && mb_strlen($this->regisseur) <= 127
        ;
    }
}
