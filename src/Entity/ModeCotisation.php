<?php

namespace App\Entity;

use App\Repository\ModeCotisationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModeCotisationRepository::class)]
class ModeCotisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $IsLibre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isLibre(): ?bool
    {
        return $this->IsLibre;
    }

    public function setIsLibre(bool $IsLibre): static
    {
        $this->IsLibre = $IsLibre;

        return $this;
    }
}
