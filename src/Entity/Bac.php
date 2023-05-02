<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BacRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity(fields:'idbac', message:'This value is already used.')]
#[ORM\Entity(repositoryClass: BacRepository::class)]
class Bac
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idbac = null;

    #[ORM\Column(length: 20)]
    private ?string $typebac = null;

    #[ORM\Column(length: 20)]
    private ?string $depbac = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $etabbac = null;



    public function getIdbac(): ?int
    {
        return $this->idbac;
    }

    public function getTypebac(): ?string
    {
        return $this->typebac;
    }

    public function setTypebac(string $typebac): self
    {
        $this->typebac = $typebac;

        return $this;
    }

    public function getDepbac(): ?string
    {
        return $this->depbac;
    }

    public function setDepbac(string $depbac): self
    {
        $this->depbac = $depbac;

        return $this;
    }

    public function getEtabbac(): ?string
    {
        return $this->etabbac;
    }

    public function setEtabbac(?string $etabbac): self
    {
        $this->etabbac = $etabbac;

        return $this;
    }

    /**
     * Set the value of idbac
     *
     * @return  self
     */ 
    public function setIdbac($idbac)
    {
        $this->idbac = $idbac;

        return $this;
    }
}
