<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $name = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

    #[ORM\OneToMany(targetEntity: Thanks::class, mappedBy: 'fromWho')]
    private Collection $thanksFrom;

    #[ORM\OneToMany(targetEntity: Thanks::class, mappedBy: 'toWho')]
    private Collection $thanksTo;

    public function __construct()
    {
        $this->thanksFrom = new ArrayCollection();
        $this->thanksTo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->name;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): static
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Collection<int, Thanks>
     */
    public function getThanksFrom(): Collection
    {
        return $this->thanksFrom;
    }

    public function addThanksFrom(Thanks $thanksFrom): static
    {
        if (!$this->thanksFrom->contains($thanksFrom)) {
            $this->thanksFrom->add($thanksFrom);
            $thanksFrom->setFromWho($this);
        }

        return $this;
    }

    public function removeThanksFrom(Thanks $thanksFrom): static
    {
        if ($this->thanksFrom->removeElement($thanksFrom)) {
            // set the owning side to null (unless already changed)
            if ($thanksFrom->getFromWho() === $this) {
                $thanksFrom->setFromWho(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Thanks>
     */
    public function getThanksTo(): Collection
    {
        return $this->thanksTo;
    }

    public function addThanksTo(Thanks $thanksTo): static
    {
        if (!$this->thanksTo->contains($thanksTo)) {
            $this->thanksTo->add($thanksTo);
            $thanksTo->setToWho($this);
        }

        return $this;
    }

    public function removeThanksTo(Thanks $thanksTo): static
    {
        if ($this->thanksTo->removeElement($thanksTo)) {
            // set the owning side to null (unless already changed)
            if ($thanksTo->getToWho() === $this) {
                $thanksTo->setToWho(null);
            }
        }

        return $this;
    }
}
