<?php

namespace App\Entity;

use App\Enum\StatutExercice;
use App\Repository\ExerciceRepository;
use App\Trait\DateTimeTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    use DateTimeTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $debutAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $finAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $limitePretsAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $retributionAt = null;

    #[ORM\Column(type: 'string', enumType: StatutExercice::class)]
    private ?StatutExercice $statut = null;

    #[ORM\ManyToOne(inversedBy: 'exercices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Groupement $groupement = null;

    public function __construct()
    {
        $this->initDate();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebutAt(): ?\DateTime
    {
        return $this->debutAt;
    }

    public function setDebutAt(\DateTime $debutAt): static
    {
        $this->debutAt = $debutAt;
        return $this;
    }

    public function getFinAt(): ?\DateTime
    {
        return $this->finAt;
    }

    public function setFinAt(?\DateTime $finAt): static
    {
        $this->finAt = $finAt;
        return $this;
    }

    public function getLimitePretsAt(): ?\DateTime
    {
        return $this->limitePretsAt;
    }

    public function setLimitePretsAt(?\DateTime $limitePretsAt): static
    {
        $this->limitePretsAt = $limitePretsAt;
        return $this;
    }

    public function getRetributionAt(): ?\DateTime
    {
        return $this->retributionAt;
    }

    public function setRetributionAt(?\DateTime $retributionAt): static
    {
        $this->retributionAt = $retributionAt;
        return $this;
    }

    public function getStatut(): ?StatutExercice
    {
        return $this->statut;
    }

    public function setStatut(StatutExercice $statut): static
    {
        $this->statut = $statut;
        return $this;
    }

    public function getGroupement(): ?Groupement
    {
        return $this->groupement;
    }

    public function setGroupement(Groupement $groupement): static
    {
        $this->groupement = $groupement;
        return $this;
    }
}
