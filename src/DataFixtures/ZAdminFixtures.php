<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Arme;
use App\Entity\Blason;
use App\Entity\Civ;
use App\Entity\Groupe;
use App\Entity\Tireur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ZAdminFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $admin = new Admin();
        $admin->setCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Monsieur')));
        $admin->setDtBirthday($faker->dateTimeBetween($startDate = '-30 years', $endDate = '-10 years', $timezone = null));
        $admin->setEmail($faker->email);
        $admin->setFirstName($faker->firstNameMale);
        $admin->setLastName($faker->lastName);
        $admin->setHandisport($faker->boolean);
        $admin->setPhone($faker->phoneNumber);
        $admin->setUsername('admin');
        $admin->setPassword($this->encoder->encodePassword($admin, 'test'));
        $admin->setCreatedAt(new \DateTime());

        $manager->persist($admin);

        $manager->flush();
    }
}
