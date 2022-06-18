<?php

namespace App\Entity;

use App\Repository\ProspectRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProspectRepository::class)
 */
class Prospect
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ProspectMail;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="prospects")
     */
    private $User;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProspectMail(): ?string
    {
        return $this->ProspectMail;
    }

    public function setProspectMail(?string $ProspectMail): self
    {
        $this->ProspectMail = $ProspectMail;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }
}
