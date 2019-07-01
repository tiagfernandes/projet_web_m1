<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdminRepository")
 */
class Admin extends User
{

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TypeCompetition", mappedBy="createdBy")
     */
    private $typeCompetitions;

    public function __construct()
    {
        parent::__construct();
        $this->typeCompetitions = new ArrayCollection();
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
            $typeCompetition->setCreatedBy($this);
        }

        return $this;
    }

    public function removeTypeCompetition(TypeCompetition $typeCompetition): self
    {
        if ($this->typeCompetitions->contains($typeCompetition)) {
            $this->typeCompetitions->removeElement($typeCompetition);
            // set the owning side to null (unless already changed)
            if ($typeCompetition->getCreatedBy() === $this) {
                $typeCompetition->setCreatedBy(null);
            }
        }

        return $this;
    }
}
