<?php

namespace App\DataFixtures;

use App\Entity\CM;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Profil;
use App\Entity\Apprenant;
use App\Entity\Formateur;
use App\DataFixtures\ProfilFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;
    public function  __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder=$encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');
        // $profil = new Profil();
        //             $profil->setLibelle("Admin");
        //             $manager->persist($profil);

        for ($i=1; $i <=2 ; $i++) {
            # code...

            $user = new User();
            $hash = $this->encoder->encodePassword($user, 'password');
            $user->setEmail($faker->email)
                ->setFirstName($faker->firstName)
                ->setLastName($faker->LastName)
                ->setPassword($hash)
                ->setProfil($this->getReference(ProfilFixtures::Profil_User))
                ->setEtat(false);
            $manager->persist($user);

            $cm = new CM();
            $hash = $this->encoder->encodePassword($cm, 'password');
            $cm->setEmail($faker->email)
                ->setFirstName($faker->firstName)
                ->setLastName($faker->LastName)
                ->setPassword($hash)
                ->setProfil($this->getReference(ProfilFixtures::Profil_CM))
                ->setEtat(false);
            $manager->persist($cm);

            $f = new Formateur();
            $hash = $this->encoder->encodePassword($f, 'password');
            $f->setEmail($faker->email)
                ->setFirstName($faker->firstName)
                ->setLastName($faker->LastName)
                ->setPassword($hash)
                ->setTelephone($faker->phoneNumber)
                ->setProfil($this->getReference(ProfilFixtures::Profil_Formateur))
                ->setEtat(false);
            $manager->persist($f);


            $a = new Apprenant();
            $hash = $this->encoder->encodePassword($a, 'password');
            $a->setEmail($faker->email)
                ->setFirstName($faker->firstName)
                ->setLastName($faker->LastName)
                ->setPassword($hash)
                ->setStatut($faker->randomElement(["actif","renvoyé","suspendu"]))
                ->setAdresse($faker->city)
                ->setAvatar("NULL")
                ->setProfil($this->getReference(ProfilFixtures::Profil_Apprenant))
                ->setEtat(false);
            $manager->persist($a);


            $manager->flush();

        }
    }

}