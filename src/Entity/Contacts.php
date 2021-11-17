<?php

namespace App\Entity; 

use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\ContactsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactsRepository::class)
 */
class Contacts
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255) 
     * @Assert\NotNull( message = "Ce champ doit être validé.")
     */
    private $nomContact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomContact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $entrepriseContact;

    /**
     * @ORM\Column(type="text")
     */
    private $messageContact;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomContact(): ?string
    {
        return $this->nomContact;
    }

    public function setNomContact(string $nomContact): self
    {
        $this->nomContact = $nomContact;

        return $this;
    }

    public function getPrenomContact(): ?string
    {
        return $this->prenomContact;
    }

    public function setPrenomContact(string $prenomContact): self
    {
        $this->prenomContact = $prenomContact;

        return $this;
    }

    public function getEntrepriseContact(): ?string
    {
        return $this->entrepriseContact;
    }

    public function setEntrepriseContact(string $entrepriseContact): self
    {
        $this->entrepriseContact = $entrepriseContact;

        return $this;
    }

    public function getMessageContact(): ?string
    {
        return $this->messageContact;
    }

    public function setMessageContact(string $messageContact): self
    {
        $this->messageContact = $messageContact;

        return $this;
    }
}
