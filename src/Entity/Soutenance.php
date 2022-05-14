<?php

namespace App\Entity;

use App\Repository\SoutenanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SoutenanceRepository::class)
 */
class Soutenance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Enseignant::class, inversedBy="soutenances")
     */
    private $NumJury;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="soutenance")
     */
    private $Numetudiant;

    /**
     * @ORM\Column(type="date")
     */
    private $date_soutenance;

    /**
     * @ORM\Column(type="float")
     */
    private $note;

    public function __construct()
    {
        $this->Numetudiant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumJury(): ?Enseignant
    {
        return $this->NumJury;
    }

    public function setNumJury(?Enseignant $NumJury): self
    {
        $this->NumJury = $NumJury;

        return $this;
    }

    /**
     * @return Collection<int, Etudiant>
     */
    public function getNumetudiant(): Collection
    {
        return $this->Numetudiant;
    }

    public function addNumetudiant(Etudiant $numetudiant): self
    {
        if (!$this->Numetudiant->contains($numetudiant)) {
            $this->Numetudiant[] = $numetudiant;
            $numetudiant->setSoutenance($this);
        }

        return $this;
    }

    public function removeNumetudiant(Etudiant $numetudiant): self
    {
        if ($this->Numetudiant->removeElement($numetudiant)) {
            // set the owning side to null (unless already changed)
            if ($numetudiant->getSoutenance() === $this) {
                $numetudiant->setSoutenance(null);
            }
        }

        return $this;
    }

    public function getDateSoutenance(): ?\DateTimeInterface
    {
        return $this->date_soutenance;
    }

    public function setDateSoutenance(\DateTimeInterface $date_soutenance): self
    {
        $this->date_soutenance = $date_soutenance;

        return $this;
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
}
