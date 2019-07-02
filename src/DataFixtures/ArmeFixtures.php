<?php

namespace App\DataFixtures;

use App\Entity\Arme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArmeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $arme1 = new Arme();
        $arme1->setName('Epée');

        $arme2 = new arme();
        $arme2->setName('Sabre');

        $arme3 = new arme();
        $arme3->setName('Fleuret');

        $manager->persist($arme1);
        $manager->persist($arme2);
        $manager->persist($arme3);

        $manager->flush();
    }
}
