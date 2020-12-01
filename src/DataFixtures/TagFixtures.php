<?php


namespace App\DataFixtures;


use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;


class TagFixtures extends Fixture
{
    public const Tag="Tag";
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($c=1; $c<=3; $c++){
            $tag = new Tag();
            $tag->setLibelle("Libelle_".$c)
                ->setDescriptif("Descriptif_".$c)
                ->addGroupeTag($this->getReference(GroupeTagFixtures::GroupeTag));
            $manager->persist($tag);
        }
        $manager->flush();
    }

}

