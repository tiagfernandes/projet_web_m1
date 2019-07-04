<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TireurRepository")
 */
class Tireur extends User
{

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Blason", inversedBy="tireurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $blason;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Arme", inversedBy="tireurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $arme;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Arbitre", inversedBy="tireur", cascade={"persist", "remove"})
     */
    private $arbitre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mainForte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Groupe", inversedBy="tireurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EntrainementTireur", mappedBy="tireur", orphanRemoval=true)
     */
    private $entrainementTireurs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lecon", mappedBy="tireur", orphanRemoval=true)
     */
    private $lecons;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscription", mappedBy="tireur", orphanRemoval=true)
     */
    private $inscriptions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Objectif", mappedBy="tireur", orphanRemoval=true)
     */
    private $objectifs;

    public function __construct()
    {
        parent::__construct();
        $this->entrainementTireurs = new ArrayCollection();
        $this->lecons = new ArrayCollection();
        $this->inscriptions = new ArrayCollection();
        $this->objectifs = new ArrayCollection();


        $this->setRoles(array('ROLE_TIREUR'));
        $this->setCreatedAt(new \DateTime());
    }

    public function getBlason(): ?Blason
    {
        return $this->blason;
    }

    public function setBlason(?Blason $blason): self
    {
        $this->blason = $blason;

        return $this;
    }

    public function getArme(): ?Arme
    {
        return $this->arme;
    }

    public function setArme(?Arme $arme): self
    {
        $this->arme = $arme;

        return $this;
    }

    public function getArbitre(): ?Arbitre
    {
        return $this->arbitre;
    }

    public function setArbitre(?Arbitre $arbitre): self
    {
        $this->arbitre = $arbitre;

        return $this;
    }

    public function getMainForte(): ?string
    {
        return $this->mainForte;
    }

    public function setMainForte(string $mainForte): self
    {
        $this->mainForte = $mainForte;

        return $this;
    }

    public function getGroupe(): ?Groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?Groupe $groupe): self
    {
        $this->groupe = $groupe;

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
            $entrainementTireur->setTireur($this);
        }

        return $this;
    }

    public function removeEntrainementTireur(EntrainementTireur $entrainementTireur): self
    {
        if ($this->entrainementTireurs->contains($entrainementTireur)) {
            $this->entrainementTireurs->removeElement($entrainementTireur);
            // set the owning side to null (unless already changed)
            if ($entrainementTireur->getTireur() === $this) {
                $entrainementTireur->setTireur(null);
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
            $lecon->setTireur($this);
        }

        return $this;
    }

    public function removeLecon(Lecon $lecon): self
    {
        if ($this->lecons->contains($lecon)) {
            $this->lecons->removeElement($lecon);
            // set the owning side to null (unless already changed)
            if ($lecon->getTireur() === $this) {
                $lecon->setTireur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Inscription[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addTypeCompetition(Inscription $typeCompetition): self
    {
        if (!$this->inscriptions->contains($typeCompetition)) {
            $this->inscriptions[] = $typeCompetition;
            $typeCompetition->setTireur($this);
        }

        return $this;
    }

    public function removeTypeCompetition(Inscription $typeCompetition): self
    {
        if ($this->inscriptions->contains($typeCompetition)) {
            $this->inscriptions->removeElement($typeCompetition);
            // set the owning side to null (unless already changed)
            if ($typeCompetition->getTireur() === $this) {
                $typeCompetition->setTireur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Objectif[]
     */
    public function getObjectifs(): Collection
    {
        return $this->objectifs;
    }

    public function addObjectif(Objectif $objectif): self
    {
        if (!$this->objectifs->contains($objectif)) {
            $this->objectifs[] = $objectif;
            $objectif->setTireur($this);
        }

        return $this;
    }

    public function removeObjectif(Objectif $objectif): self
    {
        if ($this->objectifs->contains($objectif)) {
            $this->objectifs->removeElement($objectif);
            // set the owning side to null (unless already changed)
            if ($objectif->getTireur() === $this) {
                $objectif->setTireur(null);
            }
        }

        return $this;
    }


    public function isPresentByEntrainement($id)
    {
        foreach ($this->getEntrainementTireurs() as $entrainementTireur) {
            if ($entrainementTireur->getEntrainement()->getId() === $id and $entrainementTireur->getPresent()) {
                return true;
            }
        }
        return false;
    }

    /**
     * Return categorie by age
     * @param EntityManager $em
     * @return CategorieAge|mixed|object|null
     * @throws Exception
     */
    public function getCategorieAge(EntityManager $em)
    {
        $categorieAges = $em->getRepository(CategorieAge::class)->findAll();

        $date = new DateTime();


        $dateJanury = $date;
        $dateJanury->setDate($date->format('Y'), 1, 1);

        $dateAugust = $date;
        $dateAugust->setDate($date->format('Y'), 8, 31);

        if (($dateJanury <= $date) && ($date <= $dateAugust)) {
            $date->setDate($date->format('Y') - 1, 9, 1);
        } else {
            $date->setDate($date->format('Y'), 9, 1);
        }

        $yearDiff = date_diff($this->getDtBirthday(), $date)->y;
        foreach ($categorieAges as $categorieAge) {
            if (($categorieAge->getAgeMin() <= $yearDiff) && ($yearDiff <= $categorieAge->getAgeMax())) {
                return $categorieAge;
            }
        }

        return null;
    }
}
