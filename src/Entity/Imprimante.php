<?php

namespace App\Entity;

use App\Repository\ImprimanteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImprimanteRepository::class)
 */
class Imprimante
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
    private $ImpriName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ImpriSerialNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ImpriStatus;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ImpriFeedBack;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="imprimantes")
     */
    private $User;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ID_PrintNode;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Date_debut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Date_fin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImpriName(): ?string
    {
        return $this->ImpriName;
    }

    public function setImpriName(string $ImpriName): self
    {
        $this->ImpriName = $ImpriName;

        return $this;
    }

    public function getImpriSerialNumber(): ?string
    {
        return $this->ImpriSerialNumber;
    }

    public function setImpriSerialNumber(string $ImpriSerialNumber): self
    {
        $this->ImpriSerialNumber = $ImpriSerialNumber;

        return $this;
    }

    public function getImpriStatus(): ?string
    {
        return $this->ImpriStatus;
    }

    public function setImpriStatus(?string $ImpriStatus): self
    {
        $this->ImpriStatus = $ImpriStatus;

        return $this;
    }

    public function getImpriFeedBack(): ?string
    {
        return $this->ImpriFeedBack;
    }

    public function setImpriFeedBack(?string $ImpriFeedBack): self
    {
        $this->ImpriFeedBack = $ImpriFeedBack;

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

    public function getIDPrintNode(): ?string
    {
        return $this->ID_PrintNode;
    }

    public function setIDPrintNode(?string $ID_PrintNode): self
    {
        $this->ID_PrintNode = $ID_PrintNode;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->Date_debut;
    }

    public function setDateDebut(?\DateTimeInterface $Date_debut): self
    {
        $this->Date_debut = $Date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->Date_fin;
    }

    public function setDateFin(?\DateTimeInterface $Date_fin): self
    {
        $this->Date_fin = $Date_fin;

        return $this;
    }
}
