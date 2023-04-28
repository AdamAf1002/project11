<?php

namespace App\Entity;

use App\Repository\SpecialiteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecialiteRepository::class)]
class Specialite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(length: 10)]
    private ?string $codespe = null;

    #[ORM\Column(length: 20)]
    private ?string $nomspe = null;


    public function getCodespe(): ?string
    {
        return $this->codespe;
    }

    public function getNomspe(): ?string
    {
        return $this->nomspe;
    }

    public function setNomSpe(string $nomspe): self
    {
        $this->nomspe = $nomspe;

        return $this;
    }
}
