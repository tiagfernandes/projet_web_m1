<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArmeRepository")
 */
class Arme
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
     * @ORM\OneToMany(targetEntity="App\Entity\Tireur", mappedBy="arme")
     */
    private $tireurs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Competition", mappedBy="arme")
     */
    private $competitions;

    public function __construct()
    {
        $this->tireurs = new ArrayCollection();
        $this->competitions = new ArrayCollection();
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
            $tireur->setArme($this);
        }

        return $this;
    }

    public function removeTireur(Tireur $tireur): self
    {
        if ($this->tireurs->contains($tireur)) {
            $this->tireurs->removeElement($tireur);
            // set the owning side to null (unless already changed)
            if ($tireur->getArme() === $this) {
                $tireur->setArme(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Competition[]
     */
    public function getCompetitions(): Collection
    {
        return $this->competitions;
    }

    public function addTypeCompetition(Competition $typeCompetition): self
    {
        if (!$this->competitions->contains($typeCompetition)) {
            $this->competitions[] = $typeCompetition;
            $typeCompetition->setArme($this);
        }

        return $this;
    }

    public function removeTypeCompetition(Competition $typeCompetition): self
    {
        if ($this->competitions->contains($typeCompetition)) {
            $this->competitions->removeElement($typeCompetition);
            // set the owning side to null (unless already changed)
            if ($typeCompetition->getArme() === $this) {
                $typeCompetition->setArme(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
