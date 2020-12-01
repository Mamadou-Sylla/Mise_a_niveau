<?php


namespace App\DataFixtures;


use App\Entity\GroupeCompetence;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;


class GroupeCompetenceFixtures extends Fixture
{
    public const GCompetence="Groupe Competence";

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($g=1; $g<=3; $g++) {
            $gcomp = new GroupeCompetence();
            $gcomp
                ->setLibelle("Libelle" . $g)
                ->setDescriptif("Descriptif" . $g);
            $this->addReference(self::GCompetence, $gcomp);
            $manager->persist($gcomp);
        }
        $manager->flush();
    }

}