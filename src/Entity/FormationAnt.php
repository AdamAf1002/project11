<?php

namespace App\Entity;

use App\Repository\FormationAntRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationAntRepository::class)]
class FormationAnt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(length: 10)]
    private ?string $codef = null;

    #[ORM\Column(length: 50)]
    private ?string $nomf = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $etablissement = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $diplome = null;


    public function getCodef(): ?string
    {
        return $this->codef;
    }

    public function setCodef(string $codef): self
    {
        $this->codef = $codef;

        return $this;
    }

    public function getNomf(): ?string
    {
        return $this->nomf;
    }

    public function setNomf(string $nomf): self
    {
        $this->nomf = $nomf;

        return $this;
    }

    public function getEtablissement(): ?string
    {
        return $this->etablissement;
    }

    public function setEtablissement(?string $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    public function getDiplome(): ?string
    {
        return $this->diplome;
    }

    public function setDiplome(?string $diplome): self
    {
        $this->diplome = $diplome;

        return $this;
    }
}
