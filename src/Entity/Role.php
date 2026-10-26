<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $typeRole = null;

    #[ORM\ManyToOne(inversedBy: 'role')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Membre $membre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeRole(): ?string
    {
        return $this->typeRole;
    }

    public function setTypeRole(string $typeRole): static
    {
        $this->typeRole = $typeRole;

        return $this;
    }

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): static
    {
        $this->membre = $membre;

        return $this;
    }
}
