<?php


namespace App\DataFixtures;


use App\Entity\GroupeTag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;


class GroupeTagFixtures extends Fixture
{
    public const GroupeTag="Groupe Tag";
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($c=1; $c<=3; $c++){
            $groupetag = new GroupeTag();
            $groupetag->setLibelle("Libelle_".$c)
            ->addTag($this->getReference(TagFixtures::Tag));
            $manager->persist($groupetag);
        }
        $manager->flush();
    }
}

