<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $typeRole = null;

    /**
     * @var Collection<int, Membre>
     */
    #[ORM\OneToMany(targetEntity: Membre::class, mappedBy: 'relation')]
    private Collection $groupement;

    public function __construct()
    {
        $this->groupement = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Membre>
     */
    public function getGroupement(): Collection
    {
        return $this->groupement;
    }

    public function addGroupement(Membre $groupement): static
    {
        if (!$this->groupement->contains($groupement)) {
            $this->groupement->add($groupement);
            $groupement->setRelation($this);
        }

        return $this;
    }

    public function removeGroupement(Membre $groupement): static
    {
        if ($this->groupement->removeElement($groupement)) {
            // set the owning side to null (unless already changed)
            if ($groupement->getRelation() === $this) {
                $groupement->setRelation(null);
            }
        }

        return $this;
    }
}
