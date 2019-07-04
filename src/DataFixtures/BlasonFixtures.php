<?php

namespace App\DataFixtures;

use App\Entity\Blason;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BlasonFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $Blason1 = new Blason();
        $Blason1->setGrade('Blason Jaune');

        $Blason2 = new Blason();
        $Blason2->setGrade('Blason Rouge');

        $Blason3 = new Blason();
        $Blason3->setGrade('Blason Bleu');

        $Blason4 = new Blason();
        $Blason4->setGrade('Blason Vert');

        $manager->persist($Blason1);
        $manager->persist($Blason2);
        $manager->persist($Blason3);
        $manager->persist($Blason4);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
