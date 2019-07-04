<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaitreArmesRepository")
 */
class MaitreArmes extends User
{

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lecon", mappedBy="maitreArmes", orphanRemoval=true)
     */
    private $lecons;

    public function __construct()
    {
        parent::__construct();
        $this->lecons = new ArrayCollection();

        $this->setCreatedAt(new \DateTime());
        $this->setRoles(array('ROLE_MAITRE'));
    }


    /**
     * @return Collection|Lecon[]
     */
    public function getLecons(): Collection
    {
        return $this->lecons;
    }

    public function addLecon(Lecon $lecon): self
    {
        if (!$this->lecons->contains($lecon)) {
            $this->lecons[] = $lecon;
            $lecon->setMaitreArmes($this);
        }

        return $this;
    }

    public function removeLecon(Lecon $lecon): self
    {
        if ($this->lecons->contains($lecon)) {
            $this->lecons->removeElement($lecon);
            // set the owning side to null (unless already changed)
            if ($lecon->getMaitreArmes() === $this) {
                $lecon->setMaitreArmes(null);
            }
        }

        return $this;
    }
    public function __toString()
    {

        return $this->getFirstName();
    }
}
