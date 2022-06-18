<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
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
    private $UserName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $UserPassword;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $UserMail;

    /**
     * @ORM\OneToMany(targetEntity=Imprimante::class, mappedBy="User")
     */
    private $imprimantes;

    /**
     * @ORM\OneToMany(targetEntity=Prospect::class, mappedBy="User")
     */
    private $prospects;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $qr_code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lien_gallerie;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $autorisation_partage_gallerie;

    /**
     * @ORM\OneToOne(targetEntity=TemplatesPhoto::class, cascade={"persist", "remove"})
     */
    private $templates_photo_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lien_html;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $UniqId;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_debut;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_fin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Role;

    public function __construct()
    {
        $this->imprimantes = new ArrayCollection();
        $this->prospects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->UserName;
    }

    public function setUserName(string $UserName): self
    {
        $this->UserName = $UserName;

        return $this;
    }

    public function getUserPassword(): ?string
    {
        return $this->UserPassword;
    }

    public function setUserPassword(?string $UserPassword): self
    {
        $this->UserPassword = $UserPassword;

        return $this;
    }

    public function getUserMail(): ?string
    {
        return $this->UserMail;
    }

    public function setUserMail(?string $UserMail): self
    {
        $this->UserMail = $UserMail;

        return $this;
    }

    /**
     * @return Collection|Imprimante[]
     */
    public function getImprimantes(): Collection
    {
        return $this->imprimantes;
    }

    public function addImprimante(Imprimante $imprimante): self
    {
        if (!$this->imprimantes->contains($imprimante)) {
            $this->imprimantes[] = $imprimante;
            $imprimante->setUser($this);
        }

        return $this;
    }

    public function removeImprimante(Imprimante $imprimante): self
    {
        if ($this->imprimantes->removeElement($imprimante)) {
            // set the owning side to null (unless already changed)
            if ($imprimante->getUser() === $this) {
                $imprimante->setUser(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection|Prospect[]
     */
    public function getProspects(): Collection
    {
        return $this->prospects;
    }

    public function addProspect(Prospect $prospect): self
    {
        if (!$this->prospects->contains($prospect)) {
            $this->prospects[] = $prospect;
            $prospect->setUser($this);
        }

        return $this;
    }

    public function removeProspect(Prospect $prospect): self
    {
        if ($this->prospects->removeElement($prospect)) {
            // set the owning side to null (unless already changed)
            if ($prospect->getUser() === $this) {
                $prospect->setUser(null);
            }
        }

        return $this;
    }

    public function getQrCode(): ?string
    {
        return $this->qr_code;
    }

    public function setQrCode(?string $qr_code): self
    {
        $this->qr_code = $qr_code;

        return $this;
    }

    public function getLienGallerie(): ?string
    {
        return $this->lien_gallerie;
    }

    public function setLienGallerie(?string $lien_gallerie): self
    {
        $this->lien_gallerie = $lien_gallerie;

        return $this;
    }

    public function getAutorisationPartageGallerie(): ?bool
    {
        return $this->autorisation_partage_gallerie;
    }

    public function setAutorisationPartageGallerie(?bool $autorisation_partage_gallerie): self
    {
        $this->autorisation_partage_gallerie = $autorisation_partage_gallerie;

        return $this;
    }

    public function getTemplatesPhotoId(): ?TemplatesPhoto
    {
        return $this->templates_photo_id;
    }

    public function setTemplatesPhotoId(?TemplatesPhoto $templates_photo_id): self
    {
        $this->templates_photo_id = $templates_photo_id;

        return $this;
    }

    public function getLienHtml(): ?string
    {
        return $this->lien_html;
    }

    public function setLienHtml(?string $lien_html): self
    {
        $this->lien_html = $lien_html;

        return $this;
    }

    public function getUniqId(): ?string
    {
        return $this->UniqId;
    }

    public function setUniqId(?string $UniqId): self
    {
        $this->UniqId = $UniqId;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(?\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(?\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->Role;
    }

    public function setRole(?string $Role): self
    {
        $this->Role = $Role;

        return $this;
    }
}
