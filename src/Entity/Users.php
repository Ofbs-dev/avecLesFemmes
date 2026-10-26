<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

// Classe mère : pas de table à elle (MappedSuperclass).
// Ses champs sont ajoutés à la table de chaque classe fille (ici Membre).
#[ORM\MappedSuperclass]
abstract class Users implements PasswordAuthenticatedUserInterface
{
    #[ORM\Column(length: 50, unique: true)]
    private ?string $login = null;

    // Mot de passe toujours stocké hashé, jamais en clair
    #[ORM\Column(length: 255)]
    private ?string $password = null;

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }
}
