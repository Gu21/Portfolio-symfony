<?php

namespace App\Entity;

use App\Repository\PresentationsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PresentationsRepository::class)
 */
class Presentations
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
    private $titrePresentation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sousTitrePresentation;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptifPresentation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photoPresentation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitrePresentation(): ?string
    {
        return $this->titrePresentation;
    }

    public function setTitrePresentation(string $titrePresentation): self
    {
        $this->titrePresentation = $titrePresentation;

        return $this;
    }

    public function getSousTitrePresentation(): ?string
    {
        return $this->sousTitrePresentation;
    }

    public function setSousTitrePresentation(string $sousTitrePresentation): self
    {
        $this->sousTitrePresentation = $sousTitrePresentation;

        return $this;
    }

    public function getDescriptifPresentation(): ?string
    {
        return $this->descriptifPresentation;
    }

    public function setDescriptifPresentation(string $descriptifPresentation): self
    {
        $this->descriptifPresentation = $descriptifPresentation;

        return $this;
    }

    public function getPhotoPresentation(): ?string
    {
        return $this->photoPresentation;
    }

    public function setPhotoPresentation(string $photoPresentation): self
    {
        $this->photoPresentation = $photoPresentation;

        return $this;
    }
}
