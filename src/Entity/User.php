<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *         "tireur" = "Tireur",
 *         "maitre" = "MaitreArmes",
 *         "admin" = "Admin"
 * })
 */
abstract class User implements UserInterface
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
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dtBirthday;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $handisport;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDelete;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Civ", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $civ;

    private $rawPassword;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Objectif", mappedBy="createdBy")
     */
    private $objectifsCreated;

    public function __construct()
    {
        $this->objectifsCreated = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getDtBirthday(): ?\DateTimeInterface
    {
        return $this->dtBirthday;
    }

    public function setDtBirthday(\DateTimeInterface $dtBirthday): self
    {
        $this->dtBirthday = $dtBirthday;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getHandisport(): ?bool
    {
        return $this->handisport;
    }

    public function setHandisport(?bool $handisport): self
    {
        $this->handisport = $handisport;

        return $this;
    }

    public function getIsDelete(): ?bool
    {
        return $this->isDelete;
    }

    public function setIsDelete(?bool $isDelete): self
    {
        $this->isDelete = $isDelete;

        return $this;
    }

    public function getCiv(): ?Civ
    {
        return $this->civ;
    }

    public function setCiv(?Civ $civ): self
    {
        $this->civ = $civ;

        return $this;
    }

    /**
     * @return Collection|Objectif[]
     */
    public function getObjectifsCreated(): Collection
    {
        return $this->objectifsCreated;
    }

    public function addObjectifsCreated(Objectif $objectif): self
    {
        if (!$this->objectifsCreated->contains($objectif)) {
            $this->objectifsCreated[] = $objectif;
            $objectif->setCreatedBy($this);
        }

        return $this;
    }

    public function removeObjectifsCreated(Objectif $objectif): self
    {
        if ($this->objectifsCreated->contains($objectif)) {
            $this->objectifsCreated->removeElement($objectif);
            // set the owning side to null (unless already changed)
            if ($objectif->getCreatedBy() === $this) {
                $objectif->setCreatedBy(null);
            }
        }

        return $this;
    }

    public function getSalt()
    {
        return null;
    }


    public function eraseCredentials()
    {

    }

    /**
     * @return null|string
     */
    public function getRawPassword(): ?string
    {
        return $this->rawPassword;
    }
    /**
     * @param null|string $rawPassword
     */
    public function setRawPassword(?string $rawPassword): void
    {
        $this->rawPassword = $rawPassword;
    }
}
