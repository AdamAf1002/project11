<?php

namespace App\Entity;

use App\Repository\AnneeUniversitaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnneeUniversitaireRepository::class)]
class AnneeUniversitaire
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $annee = null;

    #[ORM\OneToMany(mappedBy: 'anneeuniversitaire', targetEntity: Note::class, orphanRemoval: true)]
    private Collection $notes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }


    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    /**
     * @return Collection<int, Note>
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes->add($note);
            $note->setAnneeuniversitaire($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getAnneeuniversitaire() === $this) {
                $note->setAnneeuniversitaire(null);
            }
        }

        return $this;
    }

}
