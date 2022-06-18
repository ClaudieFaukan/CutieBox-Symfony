<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
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
    private $ImagePath;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ImageDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImagePath(): ?string
    {
        return $this->ImagePath;
    }

    public function setImagePath(string $ImagePath): self
    {
        $this->ImagePath = $ImagePath;

        return $this;
    }

    public function getImageDate(): ?\DateTimeInterface
    {
        return $this->ImageDate;
    }

    public function setImageDate(\DateTimeInterface $ImageDate): self
    {
        $this->ImageDate = $ImageDate;

        return $this;
    }
}
