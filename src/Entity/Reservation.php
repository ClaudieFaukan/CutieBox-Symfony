<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Impri_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date_debut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date_fin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Impri_status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImpriId(): ?int
    {
        return $this->Impri_id;
    }

    public function setImpriId(int $Impri_id): self
    {
        $this->Impri_id = $Impri_id;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->Date_debut;
    }

    public function setDateDebut(\DateTimeInterface $Date_debut): self
    {
        $this->Date_debut = $Date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->Date_fin;
    }

    public function setDateFin(\DateTimeInterface $Date_fin): self
    {
        $this->Date_fin = $Date_fin;

        return $this;
    }

    public function getImpriStatus(): ?string
    {
        return $this->Impri_status;
    }

    public function setImpriStatus(string $Impri_status): self
    {
        $this->Impri_status = $Impri_status;

        return $this;
    }
}
