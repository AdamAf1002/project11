<?php

namespace App\Entity;

use App\Repository\ResultatbacRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResultatbacRepository::class)]
class Resultatbac
{
    #[ORM\Id]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, name:"bac", referencedColumnName:"idbac")]
    private ?Bac $bac = null;

    #[ORM\Id]
    #[ORM\OneToOne(inversedBy: 'resultatbac', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false, name:"etudiant", referencedColumnName:"numetd")]
    private ?Etudiant $etudiant = null;

    #[ORM\Column]
    private ?int $anneebac = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $mention = null;

    #[ORM\Column]
    private ?float $moyennebac = null;

   

    public function getBac(): ?Bac
    {
        return $this->bac;
    }


    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function getAnneebac(): ?int
    {
        return $this->anneebac;
    }

    public function setAnneebac(int $anneebac): self
    {
        $this->anneebac = $anneebac;

        return $this;
    }

    public function getMention(): ?string
    {
        return $this->mention;
    }

    public function setMention(?string $mention): self
    {
        $this->mention = $mention;

        return $this;
    }

    public function getMoyennebac(): ?float
    {
        return $this->moyennebac;
    }

    public function setMoyennebac(float $moyennebac): self
    {
        $this->moyennebac = $moyennebac;

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
