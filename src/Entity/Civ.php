<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CivRepository")
 * @ApiResource
 */
class Civ
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Competition", mappedBy="civ")
     */
    private $competitions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="civ")
     */
    private $users;

    public function __construct()
    {
        $this->competitions = new ArrayCollection();
        $this->users = new ArrayCollection();
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
            $typeCompetition->addCiv($this);
        }

        return $this;
    }

    public function removeTypeCompetition(Competition $typeCompetition): self
    {
        if ($this->competitions->contains($typeCompetition)) {
            $this->competitions->removeElement($typeCompetition);
            $typeCompetition->removeCiv($this);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCiv($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getCiv() === $this) {
                $user->setCiv(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
