<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'notes')]
    #[ORM\JoinColumn(nullable: false,name:"anneeuniversitaire", referencedColumnName:"annee")]
    private ?AnneeUniversitaire $anneeuniversitaire = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'notes')]
    #[ORM\JoinColumn(nullable: false, name:"etudiant", referencedColumnName:"numetd")]
    private ?Etudiant $etudiant = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'notes')]
    #[ORM\JoinColumn(nullable: false, name:"element", referencedColumnName:"codeelt")]
    private ?Element $element = null;

    #[ORM\Column]
    private ?float $note = null;


    public function getAnneeuniversitaire(): ?AnneeUniversitaire
    {
        return $this->anneeuniversitaire;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function getElement(): ?Element
    {
        return $this->element;
    }


    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(float $note): self
    {
        $this->note = $note;

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
