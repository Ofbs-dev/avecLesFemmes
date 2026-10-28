<?php
namespace App\Entity;

use App\Enum\StatutExercice;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\Mapping as ORM;    

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateDebut = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateFin = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateLimitePrets = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateRetribution = null;

    #[ORM\Column(type: 'string', enumType: StatutExercice::class)]
    private ?StatutExercice $statut = null;

    #[ORM\ManyToOne(inversedBy: 'exercices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Groupement $groupement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeImmutable
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeImmutable $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeImmutable
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeImmutable $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getDateLimitePrets(): ?\DateTimeImmutable
    {
        return $this->dateLimitePrets;
    }

    public function setDateLimitePrets(\DateTimeImmutable $dateLimitePrets): static
    {
        $this->dateLimitePrets = $dateLimitePrets;

        return $this;
    }

    public function getDateRetribution(): ?\DateTimeImmutable
    {
        return $this->dateRetribution;
    }

    public function setDateRetribution(\DateTimeImmutable $dateRetribution): static
    {
        $this->dateRetribution = $dateRetribution;

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
