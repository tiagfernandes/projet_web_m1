<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlasonRepository")
 * @ApiResource
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
     * @ORM\OneToMany(targetEntity="App\Entity\Competition", mappedBy="blason")
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
            $typeCompetition->setBlason($this);
        }

        return $this;
    }

    public function removeTypeCompetition(Competition $typeCompetition): self
    {
        if ($this->competitions->contains($typeCompetition)) {
            $this->competitions->removeElement($typeCompetition);
            // set the owning side to null (unless already changed)
            if ($typeCompetition->getBlason() === $this) {
                $typeCompetition->setBlason(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getGrade();
    }
}
