<?php

namespace App\Entity;

use App\Repository\EnseignantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnseignantRepository::class)
 */
class Enseignant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Matricule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    private $Numetudiant;

    /**
     * @ORM\OneToMany(targetEntity=Soutenance::class, mappedBy="NumJury")
     */
    private $soutenances;

    public function __construct()
    {
        $this->Numetudiant = new ArrayCollection();
        $this->soutenances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?int
    {
        return $this->Matricule;
    }

    public function setMatricule(int $Matricule): self
    {
        $this->Matricule = $Matricule;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

  
    public function getNumetudiant(): Collection
    {
        return $this->Numetudiant;
    }

    public function addNumetudiant(Soutenance $numetudiant): self
    {
        if (!$this->Numetudiant->contains($numetudiant)) {
            $this->Numetudiant[] = $numetudiant;
            $numetudiant->setNumjury($this);
        }

        return $this;
    }

    public function removeNumetudiant(Soutenance $numetudiant): self
    {
        if ($this->Numetudiant->removeElement($numetudiant)) {
            // set the owning side to null (unless already changed)
            if ($numetudiant->getNumjury() === $this) {
                $numetudiant->setNumjury(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Soutenance>
     */
    public function getSoutenances(): Collection
    {
        return $this->soutenances;
    }

    public function addSoutenance(Soutenance $soutenance): self
    {
        if (!$this->soutenances->contains($soutenance)) {
            $this->soutenances[] = $soutenance;
            $soutenance->setNumJury($this);
        }

        return $this;
    }

    public function removeSoutenance(Soutenance $soutenance): self
    {
        if ($this->soutenances->removeElement($soutenance)) {
            // set the owning side to null (unless already changed)
            if ($soutenance->getNumJury() === $this) {
                $soutenance->setNumJury(null);
            }
        }

        return $this;
    }
}
