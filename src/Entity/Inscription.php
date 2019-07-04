<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InscriptionRepository")
 */
class Inscription
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $classement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tireur", inversedBy="inscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tireur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Competition", inversedBy="tireurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $competition;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClassement(): ?int
    {
        return $this->classement;
    }

    public function setClassement(int $classement): self
    {
        $this->classement = $classement;

        return $this;
    }

    public function getTireur(): ?Tireur
    {
        return $this->tireur;
    }

    public function setTireur(?Tireur $tireur): self
    {
        $this->tireur = $tireur;

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
