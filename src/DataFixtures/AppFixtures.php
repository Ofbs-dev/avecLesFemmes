<?php

namespace App\DataFixtures;

use App\Entity\Campagne;
use App\Entity\Groupement;
use App\Entity\Membre;
use App\Entity\ModeCotisation;
use App\Entity\Role;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $modes = [];
        $types = [];
        $roles = [];
        $groupements = [];

        $nomsTypes = ['Mensuelle', 'Ponctuelle', 'Annuelle'];
        $typesRoles = ['Président', 'Trésorier', 'Secrétaire'];

        for ($i = 0; $i < 3; $i++) {
            $mode = new ModeCotisation();
            $mode->setIsLibre($i % 2 === 0);
            $manager->persist($mode);
            $modes[] = $mode;

            $type = new Type();
            $type->setNomType($nomsTypes[$i]);
            $manager->persist($type);
            $types[] = $type;

            $role = new Role();
            $role->setTypeRole($typesRoles[$i]);
            $manager->persist($role);
            $roles[] = $role;

            $groupement = new Groupement();
            $groupement->setMontant(10000 * ($i + 1));
            $groupement->setAdresse('Adresse groupement ' . ($i + 1));
            $groupement->setTel('77000000' . $i);
            $manager->persist($groupement);
            $groupements[] = $groupement;
        }

        for ($i = 0; $i < 3; $i++) {
            $campagne = new Campagne();
            $campagne->setNom('Campagne ' . ($i + 1));
            $campagne->setDateDebut(new \DateTime('2026-0' . ($i + 1) . '-01'));
            $campagne->setDateFin(new \DateTime('2026-0' . ($i + 1) . '-28'));
            $campagne->setMontant(50000 * ($i + 1));
            $campagne->setModeCotisation($modes[$i]);
            $campagne->setType($types[$i]);
            $campagne->setGroupement($groupements[$i]);
            $manager->persist($campagne);

            $membre = new Membre();
            $membre->setLogin('membre' . ($i + 1));
            $membre->setPassword('passer123');
            $membre->setRole('membre');
            $membre->setNom('Membre ' . ($i + 1));
            $membre->setTel('78000000' . $i);
            $membre->setAdresse('Adresse membre ' . ($i + 1));
            $membre->setFonction($typesRoles[$i]);
            $membre->setModeCotisation($modes[$i]);
            $membre->setRelation($roles[$i]);
            $membre->setGroupement($groupements[$i]);
            $manager->persist($membre);
        }

        $manager->flush();
    }
}