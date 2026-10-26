<?php

namespace App\Entity;

use App\Repository\MembreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembreRepository::class)]
class Membre extends Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nom = null;

    #[ORM\Column(length: 20)]
    private ?string $tel = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ModeCotisation $ModeCotisation = null;

    /**
     * @var Collection<int, Role>
     */
    #[ORM\OneToMany(targetEntity: Role::class, mappedBy: 'membre')]
    private Collection $role;

    /**
     * @var Collection<int, Groupement>
     */
    #[ORM\OneToMany(targetEntity: Groupement::class, mappedBy: 'membre')]
    private Collection $groupement;

    public function __construct()
    {
        $this->role = new ArrayCollection();
        $this->groupement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

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

    public function getModeCotisation(): ?ModeCotisation
    {
        return $this->ModeCotisation;
    }

    public function setModeCotisation(?ModeCotisation $ModeCotisation): static
    {
        $this->ModeCotisation = $ModeCotisation;

        return $this;
    }

    /**
     * @return Collection<int, Role>
     */
    public function getRole(): Collection
    {
        return $this->role;
    }

    public function addRole(Role $role): static
    {
        if (!$this->role->contains($role)) {
            $this->role->add($role);
            $role->setMembre($this);
        }

        return $this;
    }

    public function removeRole(Role $role): static
    {
        if ($this->role->removeElement($role)) {
            // set the owning side to null (unless already changed)
            if ($role->getMembre() === $this) {
                $role->setMembre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Groupement>
     */
    public function getGroupement(): Collection
    {
        return $this->groupement;
    }

    public function addGroupement(Groupement $groupement): static
    {
        if (!$this->groupement->contains($groupement)) {
            $this->groupement->add($groupement);
            $groupement->setMembre($this);
        }

        return $this;
    }

    public function removeGroupement(Groupement $groupement): static
    {
        if ($this->groupement->removeElement($groupement)) {
            // set the owning side to null (unless already changed)
            if ($groupement->getMembre() === $this) {
                $groupement->setMembre(null);
            }
        }

        return $this;
    }
}
