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
     * @ORM\Column(type="datetime")
     */
    private $dateTimeStart;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateTimeEnd;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypeCompetition", mappedBy="competition", orphanRemoval=true)
     */
    private $typeCompetitions;

    public function __construct()
    {
        $this->typeCompetitions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateTimeStart(): ?\DateTimeInterface
    {
        return $this->dateTimeStart;
    }

    public function setDateTimeStart(\DateTimeInterface $dateTimeStart): self
    {
        $this->dateTimeStart = $dateTimeStart;

        return $this;
    }

    public function getDateTimeEnd(): ?\DateTimeInterface
    {
        return $this->dateTimeEnd;
    }

    public function setDateTimeEnd(\DateTimeInterface $dateTimeEnd): self
    {
        $this->dateTimeEnd = $dateTimeEnd;

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
            $typeCompetition->setCompetition($this);
        }

        return $this;
    }

    public function removeTypeCompetition(TypeCompetition $typeCompetition): self
    {
        if ($this->typeCompetitions->contains($typeCompetition)) {
            $this->typeCompetitions->removeElement($typeCompetition);
            // set the owning side to null (unless already changed)
            if ($typeCompetition->getCompetition() === $this) {
                $typeCompetition->setCompetition(null);
            }
        }

        return $this;
    }
}
