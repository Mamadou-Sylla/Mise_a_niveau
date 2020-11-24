<?php

namespace App\DataFixtures;

use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Profil;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfilFixtures extends Fixture
{
    public const Profil_User = 'Admin';
    public const Profil_CM = 'CM';
    public const Profil_Formateur = 'Formateur';
    public const Profil_Apprenant = 'Apprenant';




    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        $profil_user = new Profil();
        $profil_user->setLibelle("Admin");
        $this->addReference(self::Profil_User, $profil_user);
        $manager->persist($profil_user);

        $profil_cm = new Profil();
        $profil_cm->setLibelle("CM");
        $this->addReference(self::Profil_CM, $profil_cm);
        $manager->persist($profil_cm);

        $profil_formateur = new Profil();
        $profil_formateur->setLibelle("Formateur");
        $this->addReference(self::Profil_Formateur, $profil_formateur);
        $manager->persist($profil_formateur);

        $profil_apprenant = new Profil();
        $profil_apprenant->setLibelle("Apprenant");
        $this->addReference(self::Profil_Apprenant, $profil_apprenant);
        $manager->persist($profil_apprenant);


        $manager->flush();


    }

}