<?php

namespace App\Entity;

use App\Repository\TemplatesPhotoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TemplatesPhotoRepository::class)
 */
class TemplatesPhoto
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
    private $Portrait1p;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Portrait4p;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Centrer1p;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Centrer4p;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Paysage1p;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Paysage4p;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Strip;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPortrait1p(): ?string
    {
        return $this->Portrait1p;
    }

    public function setPortrait1p(?string $Portrait1p): self
    {
        $this->Portrait1p = $Portrait1p;

        return $this;
    }

    public function getPortrait4p(): ?string
    {
        return $this->Portrait4p;
    }

    public function setPortrait4p(?string $Portrait4p): self
    {
        $this->Portrait4p = $Portrait4p;

        return $this;
    }

    public function getCentrer1p(): ?string
    {
        return $this->Centrer1p;
    }

    public function setCentrer1p(?string $Centrer1p): self
    {
        $this->Centrer1p = $Centrer1p;

        return $this;
    }

    public function getCentrer4p(): ?string
    {
        return $this->Centrer4p;
    }

    public function setCentrer4p(?string $Centrer4p): self
    {
        $this->Centrer4p = $Centrer4p;

        return $this;
    }

    public function getPaysage1p(): ?string
    {
        return $this->Paysage1p;
    }

    public function setPaysage1p(?string $Paysage1p): self
    {
        $this->Paysage1p = $Paysage1p;

        return $this;
    }

    public function getPaysage4p(): ?string
    {
        return $this->Paysage4p;
    }

    public function setPaysage4p(?string $Paysage4p): self
    {
        $this->Paysage4p = $Paysage4p;

        return $this;
    }

    public function getStrip(): ?string
    {
        return $this->Strip;
    }

    public function setStrip(?string $Strip): self
    {
        $this->Strip = $Strip;

        return $this;
    }
}
