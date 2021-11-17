<?php

namespace App\Entity;

use App\Repository\TechnologiesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TechnologiesRepository::class)
 */
class Technologies
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
    private $imageTechnologie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomTechnologie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageTechnologie(): ?string
    {
        return $this->imageTechnologie;
    }

    public function setImageTechnologie(string $imageTechnologie): self
    {
        $this->imageTechnologie = $imageTechnologie;

        return $this;
    }

    public function getNomTechnologie(): ?string
    {
        return $this->nomTechnologie;
    }

    public function setNomTechnologie(string $nomTechnologie): self
    {
        $this->nomTechnologie = $nomTechnologie;

        return $this;
    }
}
