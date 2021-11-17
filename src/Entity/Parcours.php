<?php

namespace App\Entity;

use App\Repository\ParcoursRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParcoursRepository::class)
 */
class Parcours
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
    private $titreParcours;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sousTitreParcours;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDebutParcours;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFinParcours;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptifParcours;

    /**
     * @ORM\Column(type="integer")
     */
    private $ordre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreParcours(): ?string
    {
        return $this->titreParcours;
    }

    public function setTitreParcours(string $titreParcours): self
    {
        $this->titreParcours = $titreParcours;

        return $this;
    }

    public function getSousTitreParcours(): ?string
    {
        return $this->sousTitreParcours;
    }

    public function setSousTitreParcours(string $sousTitreParcours): self
    {
        $this->sousTitreParcours = $sousTitreParcours;

        return $this;
    }

    public function getDateDebutParcours(): ?\DateTimeInterface
    {
        return $this->dateDebutParcours;
    }

    public function setDateDebutParcours(\DateTimeInterface $dateDebutParcours): self
    {
        $this->dateDebutParcours = $dateDebutParcours;

        return $this;
    }

    public function getDateFinParcours(): ?\DateTimeInterface
    {
        return $this->dateFinParcours;
    }

    public function setDateFinParcours(\DateTimeInterface $dateFinParcours): self
    {
        $this->dateFinParcours = $dateFinParcours;

        return $this;
    }

    public function getDescriptifParcours(): ?string
    {
        return $this->descriptifParcours;
    }

    public function setDescriptifParcours(string $descriptifParcours): self
    {
        $this->descriptifParcours = $descriptifParcours;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }
}
