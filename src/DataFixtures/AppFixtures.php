<?php

namespace App\DataFixtures;

use App\Entity\Campagne;
use App\Entity\Exercice;
use App\Entity\Groupement;
use App\Entity\Membre;
use App\Entity\ModeCotisation;
use App\Entity\TypeCampagne;
use App\Enum\StatutExercice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $types = [];
        $groupements = [];

        $nomsTypes = ['Mensuelle', 'Ponctuelle', 'Annuelle'];

        // Création des types de campagne
        for ($i = 0; $i < 3; $i++) {
            $type = new TypeCampagne();
            $type->setNom($nomsTypes[$i]);

            $manager->persist($type);
            $types[] = $type;
        }

        // Création des groupements
        for ($i = 0; $i < 3; $i++) {
            $groupement = new Groupement();
            $groupement->setNom('Groupement ' . ($i + 1));
            $groupement->setAdresse('Adresse groupement ' . ($i + 1));
            $groupement->setTel('77000000' . $i);

            $manager->persist($groupement);
            $groupements[] = $groupement;
        }

        // Création d'un exercice pour chaque groupement
        foreach ($groupements as $i => $groupement) {
            $exercice = new Exercice();

            $exercice->setDebutAt(new \DateTime('2026-01-01'));
            $exercice->setFinAt(new \DateTime('2026-12-31'));
            $exercice->setLimitePretsAt(new \DateTime('2026-11-30'));
            $exercice->setRetributionAt(new \DateTime('2026-12-15'));
            $exercice->setStatut(StatutExercice::ENCOURS);
            $exercice->setGroupement($groupement);

            $manager->persist($exercice);
        }

        // Création des campagnes, membres et modes de cotisation
        for ($i = 0; $i < 3; $i++) {
            $campagne = new Campagne();
            $campagne->setNom('Campagne ' . ($i + 1));
            $campagne->setDateDebutAt(
                new \DateTime('2026-0' . ($i + 1) . '-01')
            );
            $campagne->setDateFinAt(
                new \DateTime('2026-0' . ($i + 1) . '-28')
            );
            $campagne->setMontant(50000 * ($i + 1));
            $campagne->setTypeCampagne($types[$i]);

            $manager->persist($campagne);

            $membre = new Membre();
            $membre->setLogin('membre' . ($i + 1));
            $membre->setPassword('passer123');
            $membre->setRole('membre');
            $membre->setNom('Membre ' . ($i + 1));
            $membre->setTel('78000000' . $i);
            $membre->setAdresse('Adresse membre ' . ($i + 1));
            $membre->setFonction('Membre');

            $manager->persist($membre);

            $mode = new ModeCotisation();
            $mode->setIsLibre($i % 2 === 0);
            $mode->setCampagne($campagne);
            $mode->setMembre($membre);

            $manager->persist($mode);
        }

        $manager->flush();
    }
}
