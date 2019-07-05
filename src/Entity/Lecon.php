<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LeconRepository")
 * @ApiResource
 */
class Lecon
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tireur", inversedBy="lecons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tireur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MaitreArmes", inversedBy="lecons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $maitreArmes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entrainement", inversedBy="lecons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entrainement;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $present;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="lecon")
     */
    private $commentaires;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->present = true;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMaitreArmes(): ?MaitreArmes
    {
        return $this->maitreArmes;
    }

    public function setMaitreArmes(?MaitreArmes $maitreArmes): self
    {
        $this->maitreArmes = $maitreArmes;

        return $this;
    }

    public function getEntrainement(): ?Entrainement
    {
        return $this->entrainement;
    }

    public function setEntrainement(?Entrainement $entrainement): self
    {
        $this->entrainement = $entrainement;

        return $this;
    }

    public function getPresent(): ?bool
    {
        return $this->present;
    }

    public function setPresent(?bool $present): self
    {
        $this->present = $present;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setLecon($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getLecon() === $this) {
                $commentaire->setLecon(null);
            }
        }

        return $this;
    }
}
