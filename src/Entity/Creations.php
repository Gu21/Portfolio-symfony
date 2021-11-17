<?php

namespace App\Entity;

use App\Entity\Technologies;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CreationsRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=CreationsRepository::class)
 */
class Creations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titreCreation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageCreation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lienCreation;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptifCreation;

    /**
     * @ORM\ManyToMany(targetEntity=Technologies::class)
     */
    private $technologies;

    public function __construct()
    {
        $this->technologies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreCreation(): ?string
    {
        return $this->titreCreation;
    }

    public function setTitreCreation(string $titreCreation): self
    {
        $this->titreCreation = $titreCreation;

        return $this;
    }

    public function getImageCreation(): ?string
    {
        return $this->imageCreation;
    }

    public function setImageCreation(string $imageCreation): self
    {
        $this->imageCreation = $imageCreation;

        return $this;
    }

    public function getLienCreation(): ?string
    {
        return $this->lienCreation;
    }

    public function setLienCreation(string $lienCreation): self
    {
        $this->lienCreation = $lienCreation;

        return $this;
    }

    public function getDescriptifCreation(): ?string
    {
        return $this->descriptifCreation;
    }

    public function setDescriptifCreation(string $descriptifCreation): self
    {
        $this->descriptifCreation = $descriptifCreation;

        return $this;
    }

    /**
     * @return Collection|Technologies[]
     */
    public function getTechnologies(): Collection
    {
        return $this->technologies;
    }

    public function addTechnology(Technologies $technology): self
    {
        if (!$this->technologies->contains($technology)) {
            $this->technologies[] = $technology;
        }

        return $this;
    }

    public function removeTechnology(Technologies $technology): self
    {
        $this->technologies->removeElement($technology);

        return $this;
    }
}
