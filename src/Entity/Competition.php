<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetitionRepository")
 */
class Competition
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Blason", inversedBy="competitions")
     * @ORM\JoinColumn(nullable=true)
     */
    private $blason;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Arme", inversedBy="competitions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $arme;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Civ", inversedBy="competitions")
     */
    private $civ;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $handisport;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscription", mappedBy="competition", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $inscriptions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\JourCompetition", inversedBy="competitions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $jourCompetition;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieAge")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;


    public function __construct()
    {
        $this->civ = new ArrayCollection();
        $this->inscriptions = new ArrayCollection();
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

    public function getJourCompetition(): ?JourCompetition
    {
        return $this->jourCompetition;
    }

    public function setJourCompetition(?JourCompetition $jourCompetition): self
    {
        $this->jourCompetition = $jourCompetition;

        return $this;
    }

    public function getCategorie(): ?CategorieAge
    {
        return $this->categorie;
    }

    public function setCategorie(?CategorieAge $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getCategories()
    {
        $categories = new ArrayCollection();
        $categorie = $this->getCategorie()->getName();
        if (!$categories->contains($categorie)) {
            $categories[] = $categorie;
        }

        return $categories;
    }


    public function getGenres()
    {
        $genres = new ArrayCollection();
        foreach ($this->getCiv() as $civ) {
            $c = $civ->getName();
            if (!$genres->contains($c)) {
                $genres[] = $c;
            }
        }

        return $genres;
    }


    /**
     * @return Collection|Inscription[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->civ->contains($inscription)) {
            $this->civ[] = $inscription;
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->civ->contains($inscription)) {
            $this->civ->removeElement($inscription);
        }

        return $this;
    }
}
