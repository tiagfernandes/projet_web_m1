<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupeRepository")
 */
class Groupe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tireur", mappedBy="groupe")
     */
    private $tireurs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Entrainement", mappedBy="groupes")
     */
    private $entrainements;

    public function __construct()
    {
        $this->tireurs = new ArrayCollection();
        $this->entrainements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Tireur[]
     */
    public function getTireurs(): Collection
    {
        return $this->tireurs;
    }

    public function addTireur(Tireur $tireur): self
    {
        if (!$this->tireurs->contains($tireur)) {
            $this->tireurs[] = $tireur;
            $tireur->setGroupe($this);
        }

        return $this;
    }

    public function removeTireur(Tireur $tireur): self
    {
        if ($this->tireurs->contains($tireur)) {
            $this->tireurs->removeElement($tireur);
            // set the owning side to null (unless already changed)
            if ($tireur->getGroupe() === $this) {
                $tireur->setGroupe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Entrainement[]
     */
    public function getEntrainements(): Collection
    {
        return $this->entrainements;
    }

    public function addEntrainement(Entrainement $entrainement): self
    {
        if (!$this->entrainements->contains($entrainement)) {
            $this->entrainements[] = $entrainement;
            $entrainement->addGroupe($this);
        }

        return $this;
    }

    public function removeEntrainement(Entrainement $entrainement): self
    {
        if ($this->entrainements->contains($entrainement)) {
            $this->entrainements->removeElement($entrainement);
            $entrainement->removeGroupe($this);
        }

        return $this;
    }
}
