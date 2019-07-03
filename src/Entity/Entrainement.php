<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntrainementRepository")
 */
class Entrainement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\DateTime()
     * @ORM\Column(type="datetime")
     */
    private $dateTimeStart;

    /**
     * @Assert\DateTime()
     * @Assert\GreaterThanOrEqual(
     *     propertyPath="dateTimeStart"
     * )
     * @ORM\Column(type="datetime")
     */
    private $dateTimeEnd;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Groupe", inversedBy="entrainements")
     */
    private $groupes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EntrainementTireur", mappedBy="entrainement", orphanRemoval=true)
     */
    private $entrainementTireurs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lecon", mappedBy="entrainement", orphanRemoval=true)
     */
    private $lecons;

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
        $this->entrainementTireurs = new ArrayCollection();
        $this->lecons = new ArrayCollection();
        $this->setDateTimeStart(new DateTime());
        $this->setDateTimeEnd(new DateTime());
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
     * @return Collection|Groupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->contains($groupe)) {
            $this->groupes->removeElement($groupe);
        }

        return $this;
    }

    /**
     * @return Collection|EntrainementTireur[]
     */
    public function getEntrainementTireurs(): Collection
    {
        return $this->entrainementTireurs;
    }

    public function addEntrainementTireur(EntrainementTireur $entrainementTireur): self
    {
        if (!$this->entrainementTireurs->contains($entrainementTireur)) {
            $this->entrainementTireurs[] = $entrainementTireur;
            $entrainementTireur->setEntrainement($this);
        }

        return $this;
    }

    public function removeEntrainementTireur(EntrainementTireur $entrainementTireur): self
    {
        if ($this->entrainementTireurs->contains($entrainementTireur)) {
            $this->entrainementTireurs->removeElement($entrainementTireur);
            // set the owning side to null (unless already changed)
            if ($entrainementTireur->getEntrainement() === $this) {
                $entrainementTireur->setEntrainement(null);
            }
        }

        return $this;
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
            $lecon->setEntrainement($this);
        }

        return $this;
    }

    public function removeLecon(Lecon $lecon): self
    {
        if ($this->lecons->contains($lecon)) {
            $this->lecons->removeElement($lecon);
            // set the owning side to null (unless already changed)
            if ($lecon->getEntrainement() === $this) {
                $lecon->setEntrainement(null);
            }
        }

        return $this;
    }
}
