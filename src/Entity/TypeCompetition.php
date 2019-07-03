<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeCompetitionRepository")
 */
class TypeCompetition
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Blason", inversedBy="typeCompetitions")
     * @ORM\JoinColumn(nullable=true)
     */
    private $blason;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Arme", inversedBy="typeCompetitions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $arme;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Civ", inversedBy="typeCompetitions")
     */
    private $civ;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $handisport;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TireurCompetition", mappedBy="typeCompetition", orphanRemoval=true)
     */
    private $tireurs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Competition", inversedBy="typeCompetitions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $competition;


    public function __construct()
    {
        $this->civ = new ArrayCollection();
        $this->tireurCompetitions = new ArrayCollection();
        $this->tireurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBlason(): ?Blason
    {
        return $this->blason;
    }

    public function setBlason(?Blason $blason): self
    {
        $this->blason = $blason;

        return $this;
    }

    public function getArme(): ?Arme
    {
        return $this->arme;
    }

    public function setArme(?Arme $arme): self
    {
        $this->arme = $arme;

        return $this;
    }

    /**
     * @return Collection|Civ[]
     */
    public function getCiv(): Collection
    {
        return $this->civ;
    }

    public function addCiv(Civ $civ): self
    {
        if (!$this->civ->contains($civ)) {
            $this->civ[] = $civ;
        }

        return $this;
    }

    public function removeCiv(Civ $civ): self
    {
        if ($this->civ->contains($civ)) {
            $this->civ->removeElement($civ);
        }

        return $this;
    }

    public function getHandisport(): ?bool
    {
        return $this->handisport;
    }

    public function setHandisport(?bool $handisport): self
    {
        $this->handisport = $handisport;

        return $this;
    }

    /**
     * @return Collection|TireurCompetition[]
     */
    public function getTireurs(): Collection
    {
        return $this->tireurs;
    }

    public function addTireur(TireurCompetition $tireur): self
    {
        if (!$this->tireurs->contains($tireur)) {
            $this->tireurs[] = $tireur;
            $tireur->setTypeCompetition($this);
        }

        return $this;
    }

    public function removeTireur(TireurCompetition $tireur): self
    {
        if ($this->tireurs->contains($tireur)) {
            $this->tireurs->removeElement($tireur);
            // set the owning side to null (unless already changed)
            if ($tireur->getTypeCompetition() === $this) {
                $tireur->setTypeCompetition(null);
            }
        }

        return $this;
    }

    public function getCompetition(): ?Competition
    {
        return $this->competition;
    }

    public function setCompetition(?Competition $competition): self
    {
        $this->competition = $competition;

        return $this;
    }
}
