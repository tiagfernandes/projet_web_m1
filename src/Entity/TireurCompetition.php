<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TireurCompetitionRepository")
 */
class TireurCompetition
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Tireur", inversedBy="typeCompetitions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tireur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeCompetition", inversedBy="tireurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeCompetition;


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

    public function getTypeCompetition(): ?TypeCompetition
    {
        return $this->typeCompetition;
    }

    public function setTypeCompetition(?TypeCompetition $typeCompetition): self
    {
        $this->typeCompetition = $typeCompetition;

        return $this;
    }
}
