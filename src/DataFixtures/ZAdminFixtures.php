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
        $admin->setCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Homme')));
        $admin->setDtBirthday($faker->dateTimeBetween($startDate = '-30 years', $endDate = '-10 years', $timezone = null));
        $admin->setEmail($faker->email);
        $admin->setFirstName($faker->firstNameMale);
        $admin->setLastName($faker->lastName);
        $admin->setHandisport($faker->boolean);
        $admin->setPhone($faker->phoneNumber);
        $admin->setRoles(array('ROLE_ADMIN'));
        $admin->setUsername('admin1');
        $admin->setPassword($this->encoder->encodePassword($admin, 'test'));

        $manager->persist($admin);

        $admin2 = new Admin();
        $admin2->setCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Femme')));
        $admin2->setDtBirthday($faker->dateTimeBetween($startDate = '-30 years', $endDate = '-10 years', $timezone = null));
        $admin2->setEmail($faker->email);
        $admin2->setFirstName($faker->firstNameMale);
        $admin2->setLastName($faker->lastName);
        $admin2->setHandisport($faker->boolean);
        $admin2->setPhone($faker->phoneNumber);
        $admin2->setRoles(array('ROLE_ADMIN'));
        $admin2->setUsername('admin2');
        $admin2->setPassword($this->encoder->encodePassword($admin2, 'test'));

        $manager->persist($admin2);

        $manager->flush();
    }

    public function getOrder()
    {
        return 8;
    }
}
