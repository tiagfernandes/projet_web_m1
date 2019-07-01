<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlasonRepository")
 */
class Blason
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
    private $grade;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tireur", mappedBy="blason")
     */
    private $tireurs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypeCompetition", mappedBy="blason")
     */
    private $typeCompetitions;

    public function __construct()
    {
        $this->tireurs = new ArrayCollection();
        $this->typeCompetitions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

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
            $tireur->setBlason($this);
        }

        return $this;
    }

    public function removeTireur(Tireur $tireur): self
    {
        if ($this->tireurs->contains($tireur)) {
            $this->tireurs->removeElement($tireur);
            // set the owning side to null (unless already changed)
            if ($tireur->getBlason() === $this) {
                $tireur->setBlason(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TypeCompetition[]
     */
    public function getTypeCompetitions(): Collection
    {
        return $this->typeCompetitions;
    }

    public function addTypeCompetition(TypeCompetition $typeCompetition): self
    {
        if (!$this->typeCompetitions->contains($typeCompetition)) {
            $this->typeCompetitions[] = $typeCompetition;
            $typeCompetition->setBlason($this);
        }

        return $this;
    }

    public function removeTypeCompetition(TypeCompetition $typeCompetition): self
    {
        if ($this->typeCompetitions->contains($typeCompetition)) {
            $this->typeCompetitions->removeElement($typeCompetition);
            // set the owning side to null (unless already changed)
            if ($typeCompetition->getBlason() === $this) {
                $typeCompetition->setBlason(null);
            }
        }

        return $this;
    }
}
