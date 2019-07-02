<?php

namespace App\DataFixtures;

use App\Entity\Groupe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GroupeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $groupe1 = new Groupe();
        $groupe1->setName('Groupe1');

        $groupe2 = new Groupe();
        $groupe2->setName('Groupe2');

        $groupe3 = new Groupe();
        $groupe3->setName('Groupe3');

        $groupe4 = new Groupe();
        $groupe4->setName('Groupe4');

        $manager->persist($groupe1);
        $manager->persist($groupe2);
        $manager->persist($groupe3);
        $manager->persist($groupe4);

        $manager->flush();
    }
}
