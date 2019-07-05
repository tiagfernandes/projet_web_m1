<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArbitreRepository")
 * @ApiResource
 */
class Arbitre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $licence;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NiveauArbitrage", inversedBy="arbitres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $niveauArbitre;

    /**
     * TODO Check relation 0.1
     * @ORM\OneToOne(targetEntity="App\Entity\Tireur", mappedBy="arbitre", cascade={"persist", "remove"})
     */
    private $tireur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLicence(): ?bool
    {
        return $this->licence;
    }

    public function setLicence(?bool $licence): self
    {
        $this->licence = $licence;

        return $this;
    }

    public function getNiveauArbitre(): ?NiveauArbitrage
    {
        return $this->niveauArbitre;
    }

    public function setNiveauArbitre(?NiveauArbitrage $niveauArbitre): self
    {
        $this->niveauArbitre = $niveauArbitre;

        return $this;
    }

    public function getTireur(): ?Tireur
    {
        return $this->tireur;
    }

    public function setTireur(?Tireur $tireur): self
    {
        $this->tireur = $tireur;

        // set (or unset) the owning side of the relation if necessary
        $newArbitre = $tireur === null ? null : $this;
        if ($newArbitre !== $tireur->getArbitre()) {
            $tireur->setArbitre($newArbitre);
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getId();
    }

}
