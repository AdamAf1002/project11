<?php

namespace App\Entity;

use App\Repository\ChoixRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChoixRepository::class)]
class Choix
{
    #[ORM\Id]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, name:"specialite", referencedColumnName:"codespe")]
    private ?Specialite $specialite = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'choixes')]
    #[ORM\JoinColumn(nullable: false, name:"etudiant", referencedColumnName:"numetd")]
    private ?Etudiant $etudiant = null;

    #[ORM\Column]
    private ?bool $enterminale = null;


    public function getSpecialite(): ?Specialite
    {
        return $this->specialite;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function isEnterminale(): ?bool
    {
        return $this->enterminale;
    }

    public function setEnterminale(bool $enterminale): self
    {
        $this->enterminale = $enterminale;

        return $this;
    }
}
