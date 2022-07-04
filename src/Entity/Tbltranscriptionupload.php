<?php

namespace App\Entity;

use App\Repository\TbltranscriptionuploadRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TbltranscriptionuploadRepository::class)]
class Tbltranscriptionupload
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $itmTitreLg1;

    #[ORM\Column(type: 'text', nullable: true)]
    private $itmTxtClientLg1;

    #[ORM\Column(type: 'date')]
    private $itmDate;

    #[ORM\Column(type: 'string', length: 255)]
    private $itmType;

    #[ORM\Column(type: 'string', length: 255)]
    private $itmTaille;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $itmDuree;

    #[ORM\Column(type: 'boolean')]
    private $itmATranscrire;

    #[ORM\Column(type: 'date', nullable: true)]
    private $itmDeadlineRequise;

    #[ORM\ManyToOne(targetEntity: Tblclient::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $Tblclient;

    #[ORM\Column(type: 'string', length: 255)]
    private $itmFichier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItmTitreLg1(): ?string
    {
        return $this->itmTitreLg1;
    }

    public function setItmTitreLg1(string $itmTitreLg1): self
    {
        $this->itmTitreLg1 = $itmTitreLg1;

        return $this;
    }

    public function getItmTxtClientLg1(): ?string
    {
        return $this->itmTxtClientLg1;
    }

    public function setItmTxtClientLg1(?string $itmTxtClientLg1): self
    {
        $this->itmTxtClientLg1 = $itmTxtClientLg1;

        return $this;
    }

    public function getItmDate(): ?\DateTimeInterface
    {
        return $this->itmDate;
    }

    public function setItmDate(\DateTimeInterface $itmDate): self
    {
        $this->itmDate = $itmDate;

        return $this;
    }

    public function getItmType(): ?string
    {
        return $this->itmType;
    }

    public function setItmType(string $itmType): self
    {
        $this->itmType = $itmType;

        return $this;
    }

    public function getItmTaille(): ?string
    {
        return $this->itmTaille;
    }

    public function setItmTaille(string $itmTaille): self
    {
        $this->itmTaille = $itmTaille;

        return $this;
    }

    public function getItmDuree(): ?int
    {
        return $this->itmDuree;
    }

    public function setItmDuree(?int $itmDuree): self
    {
        $this->itmDuree = $itmDuree;

        return $this;
    }

    public function isItmATranscrire(): ?bool
    {
        return $this->itmATranscrire;
    }

    public function setItmATranscrire(bool $itmATranscrire): self
    {
        $this->itmATranscrire = $itmATranscrire;

        return $this;
    }

    public function getItmDeadlineRequise(): ?\DateTimeInterface
    {
        return $this->itmDeadlineRequise;
    }

    public function setItmDeadlineRequise($itmDeadlineRequise): self
    {
        $this->itmDeadlineRequise = $itmDeadlineRequise;

        return $this;
    }

    public function getTblclient(): ?Tblclient
    {
        return $this->Tblclient;
    }

    public function setTblclient(?Tblclient $Tblclient): self
    {
        $this->Tblclient = $Tblclient;

        return $this;
    }

    public function getItmFichier(): ?string
    {

        return $this->itmFichier;
    }

    public function setItmFichier(string $itmFichier): self
    {
        $this->itmFichier = $itmFichier;

        return $this;
    }
}
