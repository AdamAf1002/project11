<?php

namespace App\Entity;

use App\Repository\EtudsupRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudsupRepository::class)]
class Etudsup
{
    #[ORM\Id]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false,name:"formation", referencedColumnName:"codef")]
    private ?FormationAnt $formation = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'etudsups')]
    #[ORM\JoinColumn(nullable: false,name:"etudiant", referencedColumnName:"numetd")]
    private ?Etudiant $etudiant = null;

    #[ORM\Column(nullable: true)]
    private ?int $anneedeb = null;

   
    public function getFormation(): ?FormationAnt
    {
        return $this->formation;
    }


    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    

    public function getAnneedeb(): ?int
    {
        return $this->anneedeb;
    }

    public function setAnneedeb(?int $anneedeb): self
    {
        $this->anneedeb = $anneedeb;

        return $this;
    }

    /**
     * Set the value of etudiant
     *
     * @return  self
     */ 
    public function setEtudiant($etudiant)
    {
        $this->etudiant = $etudiant;

        return $this;
    }
}
