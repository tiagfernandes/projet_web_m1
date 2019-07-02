<?php

namespace App\DataFixtures;

use App\Entity\Arme;
use App\Entity\Blason;
use App\Entity\Civ;
use App\Entity\Groupe;
use App\Entity\MaitreArmes;
use App\Entity\Tireur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MaitreArmesFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $maitre = new MaitreArmes();
        $maitre->setCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Monsieur')));
        $maitre->setDtBirthday($faker->dateTimeBetween($startDate = '-60 years', $endDate = '-20 years', $timezone = null));
        $maitre->setEmail($faker->email);
        $maitre->setFirstName($faker->firstNameMale);
        $maitre->setLastName($faker->lastName);
        $maitre->setHandisport($faker->boolean);
        $maitre->setPhone($faker->phoneNumber);
        $maitre->setUsername('maitre1');
        $maitre->setPassword($this->encoder->encodePassword($maitre, 'test'));

        $manager->persist($maitre);

        $maitre = new MaitreArmes();
        $maitre->setCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Madame')));
        $maitre->setDtBirthday($faker->dateTimeBetween($startDate = '-60 years', $endDate = '-20 years', $timezone = null));
        $maitre->setEmail($faker->email);
        $maitre->setFirstName($faker->firstNameMale);
        $maitre->setLastName($faker->lastName);
        $maitre->setHandisport($faker->boolean);
        $maitre->setPhone($faker->phoneNumber);
        $maitre->setUsername('maitre2');
        $maitre->setPassword($this->encoder->encodePassword($maitre, 'test'));

        $manager->persist($maitre);

        $manager->flush();
    }
}
