<?php

namespace KaiBoerner\MovieDb\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Movie
 *
 * @ORM\Table(name="movie", indexes={@ORM\Index(name="IDX_1D5EF26FDE12AB56", columns={"created_by"})})
 * @ORM\Entity
 */
class Movie
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private ?int $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private string $title = '';

    /**
     * @var string
     *
     * @ORM\Column(name="regisseur", type="string", length=127, nullable=false)
     */
    private string $regisseur = '';

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="publication", type="date_immutable", nullable=false)
     */
    private \DateTimeImmutable $publication;

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="created", type="datetime_immutable", nullable=false)
     */
    private \DateTimeImmutable $created;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="KaiBoerner\MovieDb\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     * })
     */
    private User $createdBy;


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

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
