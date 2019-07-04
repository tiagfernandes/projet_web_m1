<?php

namespace App\DataFixtures;

use App\Entity\Arme;
use App\Entity\CategorieAge;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategorieAgeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categorie1 = new CategorieAge();
        $categorie1->setName('M5');
        $categorie1->setAgeMin(0);
        $categorie1->setAgeMax(5);

        $manager->persist($categorie1);

        $categorie2 = new CategorieAge();
        $categorie2->setName('M7');
        $categorie2->setAgeMin(6);
        $categorie2->setAgeMax(7);

        $manager->persist($categorie2);

        $categorie3 = new CategorieAge();
        $categorie3->setName('M9');
        $categorie3->setAgeMin(8);
        $categorie3->setAgeMax(9);

        $manager->persist($categorie3);

        $categorie4 = new CategorieAge();
        $categorie4->setName('M11');
        $categorie4->setAgeMin(10);
        $categorie4->setAgeMax(11);

        $manager->persist($categorie4);

        $categorie5 = new CategorieAge();
        $categorie5->setName('M13');
        $categorie5->setAgeMin(12);
        $categorie5->setAgeMax(13);

        $manager->persist($categorie5);

        $categorie6 = new CategorieAge();
        $categorie6->setName('M15');
        $categorie6->setAgeMin(14);
        $categorie6->setAgeMax(15);

        $manager->persist($categorie6);

        $categorie7 = new CategorieAge();
        $categorie7->setName('M17');
        $categorie7->setAgeMin(16);
        $categorie7->setAgeMax(17);

        $manager->persist($categorie7);

        $categorie8 = new CategorieAge();
        $categorie8->setName('M20');
        $categorie8->setAgeMin(18);
        $categorie8->setAgeMax(20);

        $manager->persist($categorie8);

        $categorie9 = new CategorieAge();
        $categorie9->setName('Séniors');
        $categorie9->setAgeMin(21);
        $categorie9->setAgeMax(39);

        $manager->persist($categorie9);

        $categorie10 = new CategorieAge();
        $categorie10->setName('Vétérans');
        $categorie10->setAgeMin(40);
        $categorie10->setAgeMax(120);

        $manager->persist($categorie10);

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
