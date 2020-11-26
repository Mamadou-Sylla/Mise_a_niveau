<?php


namespace App\DataFixtures;


use App\Entity\Competence;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;


class CompetenceFixtures extends Fixture
{
    public const Competence="Community Manager";

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
            $competence = new Competence();
            $competence
                ->setLibelle("Community Manager");
           $this->addReference(self::Competence, $competence);
            $manager->persist($competence);


        $manager->flush();
    }

}