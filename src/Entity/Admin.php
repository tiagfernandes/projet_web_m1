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
     * @ORM\OneToMany(targetEntity="App\Entity\Competition", mappedBy="createdBy")
     */
    private $competitions;

    public function __construct()
    {
        parent::__construct();
        $this->competitions = new ArrayCollection();
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
            $typeCompetition->setCreatedBy($this);
        }

        return $this;
    }

    public function removeTypeCompetition(Competition $typeCompetition): self
    {
        if ($this->competitions->contains($typeCompetition)) {
            $this->competitions->removeElement($typeCompetition);
            // set the owning side to null (unless already changed)
            if ($typeCompetition->getCreatedBy() === $this) {
                $typeCompetition->setCreatedBy(null);
            }
        }

        return $this;
    }
}
