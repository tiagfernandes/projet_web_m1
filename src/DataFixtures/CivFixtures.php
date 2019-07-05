<?php

namespace App\DataFixtures;

use App\Entity\Civ;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CivFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $Civ1 = new Civ();
        $Civ1->setName('Homme');

        $Civ2 = new Civ();
        $Civ2->setName('Femme');

        $manager->persist($Civ1);
        $manager->persist($Civ2);

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
