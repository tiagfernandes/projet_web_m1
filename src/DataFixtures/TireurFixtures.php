<?php

namespace App\DataFixtures;

use App\Entity\Arme;
use App\Entity\Blason;
use App\Entity\Civ;
use App\Entity\Groupe;
use App\Entity\Tireur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class TireurFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $tireur = new Tireur();
        $tireur->setCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Monsieur')));
        $tireur->setDtBirthday($faker->dateTimeBetween($startDate = '-30 years', $endDate = '-10 years', $timezone = null));
        $tireur->setEmail($faker->email);
        $tireur->setFirstName($faker->firstNameMale);
        $tireur->setLastName($faker->lastName);
        $tireur->setHandisport($faker->boolean);
        $tireur->setPhone($faker->phoneNumber);
        $tireur->setUsername('tireur');
        $tireur->setArme($manager->getRepository(Arme::class)->findOneBy(array('name' => 'Epée')));
        $tireur->setMainForte('Droite');
        $tireur->setBlason($manager->getRepository(Blason::class)->findOneBy(array('grade' => 'Blason Jaune')));
        $tireur->setGroupe($manager->getRepository(Groupe::class)->findOneBy(array('name' => 'Groupe1')));
        $tireur->setPassword($this->encoder->encodePassword($tireur, 'test'));

        $manager->persist($tireur);

        $tireur = new Tireur();
        $tireur->setCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Madame')));
        $tireur->setDtBirthday($faker->dateTimeBetween($startDate = '-30 years', $endDate = '-10 years', $timezone = null));
        $tireur->setEmail($faker->email);
        $tireur->setFirstName($faker->firstNameMale);
        $tireur->setLastName($faker->lastName);
        $tireur->setHandisport($faker->boolean);
        $tireur->setPhone($faker->phoneNumber);
        $tireur->setUsername('tireur2');
        $tireur->setArme($manager->getRepository(Arme::class)->findOneBy(array('name' => 'Epée')));
        $tireur->setMainForte('Droite');
        $tireur->setBlason($manager->getRepository(Blason::class)->findOneBy(array('grade' => 'Blason Jaune')));
        $tireur->setGroupe($manager->getRepository(Groupe::class)->findOneBy(array('name' => 'Groupe1')));
        $tireur->setPassword($this->encoder->encodePassword($tireur, 'test'));

        $manager->persist($tireur);

        $manager->flush();
    }
}
