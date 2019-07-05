<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NiveauArbitrageRepository")
 * @ApiResource
 */
class NiveauArbitrage
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Arbitre", mappedBy="niveauArbitre")
     */
    private $arbitres;

    public function __construct()
    {
        $this->arbitres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Arbitre[]
     */
    public function getArbitres(): Collection
    {
        return $this->arbitres;
    }

    public function addArbitre(Arbitre $arbitre): self
    {
        if (!$this->arbitres->contains($arbitre)) {
            $this->arbitres[] = $arbitre;
            $arbitre->setNiveauArbitre($this);
        }

        return $this;
    }

    public function removeArbitre(Arbitre $arbitre): self
    {
        if ($this->arbitres->contains($arbitre)) {
            $this->arbitres->removeElement($arbitre);
            // set the owning side to null (unless already changed)
            if ($arbitre->getNiveauArbitre() === $this) {
                $arbitre->setNiveauArbitre(null);
            }
        }

        return $this;
    }
    public function __toString()
    {

        return $this->getName();
    }
}
