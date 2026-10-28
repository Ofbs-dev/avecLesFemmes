<?php

namespace App\Entity;

use App\Repository\MembreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembreRepository::class)]
class Membre extends Users
{
    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $tel = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $fonction = null;

    #[ORM\ManyToOne(inversedBy: 'role')]
    private ?ModeCotisation $modeCotisation = null;

    #[ORM\ManyToOne(inversedBy: 'groupement')]
    private ?Role $relation = null;

    #[ORM\ManyToOne(inversedBy: 'membres')]
    private ?Groupement $groupement = null;


    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(string $fonction): static
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getModeCotisation(): ?ModeCotisation
    {
        return $this->modeCotisation;
    }

    public function setModeCotisation(?ModeCotisation $modeCotisation): static
    {
        $this->modeCotisation = $modeCotisation;

        return $this;
    }

    public function getRelation(): ?Role
    {
        return $this->relation;
    }

    public function setRelation(?Role $relation): static
    {
        $this->relation = $relation;

        return $this;
    }

    public function getGroupement(): ?Groupement
    {
        return $this->groupement;
    }

    public function setGroupement(?Groupement $groupement): static
    {
        $this->groupement = $groupement;

        return $this;
    }
}
