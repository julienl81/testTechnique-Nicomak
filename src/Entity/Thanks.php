<?php

namespace App\Entity;

use App\Repository\ThanksRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ThanksRepository::class)]
class Thanks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'thanksFrom')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $fromWho = null;

    #[ORM\ManyToOne(inversedBy: 'thanksTo')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $toWho = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromWho(): ?User
    {
        return $this->fromWho;
    }

    public function setFromWho(?User $fromWho): static
    {
        $this->fromWho = $fromWho;

        return $this;
    }

    public function getToWho(): ?User
    {
        return $this->toWho;
    }

    public function setToWho(?User $toWho): static
    {
        $this->toWho = $toWho;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
