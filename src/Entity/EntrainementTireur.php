<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntrainementTireurRepository")
 */
class EntrainementTireur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tireur", inversedBy="entrainementTireurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tireur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entrainement", inversedBy="entrainementTireurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entrainement;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $present;

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

    public function setPresent(bool $present): self
    {
        $this->present = $present;

        return $this;
    }
}
