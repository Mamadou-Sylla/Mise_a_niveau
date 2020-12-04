<?php


namespace App\DataFixtures;


use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Referentiel;
use Doctrine\Bundle\FixturesBundle\Fixture;


class ReferentielFixtures extends Fixture
{

    public const Referentiel="Referentiel";

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($g=1; $g<=3; $g++) {
            $ref = new Referentiel();
            $ref
                ->setLibelle("Libelle" . $g)
                ->setPresentation("Presentation" . $g)
                ->setProgramme("Programme" . $g)
                ->setCritereAdmission("CritereAdmission" . $g)
                ->setCritereEvaluation("CritereEvaluation" . $g)
                ->addGroupecompetence($this->getReference(GroupeCompetenceFixtures::GCompetence));
            $this->addReference(self::Referentiel, $ref);
            $manager->persist($ref);
        }
        $manager->flush();
    }

}