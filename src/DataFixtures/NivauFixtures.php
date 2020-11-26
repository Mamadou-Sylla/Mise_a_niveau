<?php


namespace App\DataFixtures;

use App\Entity\Niveau;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class NivauFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i<=3; $i++){
            $niveau = new Niveau();
            $niveau
                ->setLibelle("Niveau".$i)
                ->setCritereEvalution("setCritereEvalution".$i)
                ->setGroupeAction("setGroupeAction".$i)
                ->setCompetence($this->getReference(CompetenceFixtures::Competence));
            $manager->persist($niveau);
        }

        $manager->flush();
    }
}