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
    private $NumEtudiant;

    /**
     * @ORM\Column(type="date")
     */
    private $Date_soutenance;

    /**
     * @ORM\Column(type="float")
     */
    private $Note;

    public function __construct()
    {
        $this->NumEtudiant = new ArrayCollection();
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
    public function getNumEtudiant(): Collection
    {
        return $this->NumEtudiant;
    }

    public function addNumEtudiant(Etudiant $numEtudiant): self
    {
        if (!$this->NumEtudiant->contains($numEtudiant)) {
            $this->NumEtudiant[] = $numEtudiant;
            $numEtudiant->setSoutenance($this);
        }

        return $this;
    }

    public function removeNumEtudiant(Etudiant $numEtudiant): self
    {
        if ($this->NumEtudiant->removeElement($numEtudiant)) {
            // set the owning side to null (unless already changed)
            if ($numEtudiant->getSoutenance() === $this) {
                $numEtudiant->setSoutenance(null);
            }
        }

        return $this;
    }

    public function getDateSoutenance(): ?\DateTimeInterface
    {
        return $this->Date_soutenance;
    }

    public function setDateSoutenance(\DateTimeInterface $Date_soutenance): self
    {
        $this->Date_soutenance = $Date_soutenance;

        return $this;
    }

    public function getNote(): ?float
    {
        return $this->Note;
    }

    public function setNote(float $Note): self
    {
        $this->Note = $Note;

        return $this;
    }
}
