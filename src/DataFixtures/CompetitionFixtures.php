<?php

namespace App\DataFixtures;

use App\Entity\Arme;
use App\Entity\Blason;
use App\Entity\CategorieAge;
use App\Entity\Civ;
use App\Entity\Competition;
use App\Entity\Groupe;
use App\Entity\JourCompetition;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class CompetitionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 50; $i++) {
            $jourCompet1 = new JourCompetition();
            $date = $faker->dateTimeBetween($startDate = '2 month', $endDate = '1 year', $timezone = null);
            $jourCompet1->setDateTimeStart($date);
            $jourCompet1->setDateTimeEnd($date);

            $competition1 = new Competition();
            $competition1->setBlason($manager->getRepository(Blason::class)->findOneBy(array('grade' => 'Blason Jaune')));
            $competition1->setArme($manager->getRepository(Arme::class)->findOneBy(array('name' => 'Epée')));
            $competition1->setCategorie($manager->getRepository(CategorieAge::class)->findOneBy(array('name' => 'M17')));
            $competition1->setHandisport(false);
            $competition1->setJourCompetition($jourCompet1);
            $competition1->addCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Homme')));
            $competition1->addCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Femme')));

            $competition2 = new Competition();
            $competition2->setBlason($manager->getRepository(Blason::class)->findOneBy(array('grade' => 'Blason Jaune')));
            $competition2->setArme($manager->getRepository(Arme::class)->findOneBy(array('name' => 'Epée')));
            $competition2->setCategorie($manager->getRepository(CategorieAge::class)->findOneBy(array('name' => 'M15')));
            $competition2->setHandisport(false);
            $competition2->setJourCompetition($jourCompet1);
            $competition2->addCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Homme')));
            $competition2->addCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Femme')));

            $competition3 = new Competition();
            $competition3->setBlason($manager->getRepository(Blason::class)->findOneBy(array('grade' => 'Blason Jaune')));
            $competition3->setArme($manager->getRepository(Arme::class)->findOneBy(array('name' => 'Epée')));
            $competition3->setCategorie($manager->getRepository(CategorieAge::class)->findOneBy(array('name' => 'M13')));
            $competition3->setHandisport(false);
            $competition3->setJourCompetition($jourCompet1);
            $competition3->addCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Homme')));
            $competition3->addCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Femme')));

            $competition4 = new Competition();
            $competition4->setBlason($manager->getRepository(Blason::class)->findOneBy(array('grade' => 'Blason Jaune')));
            $competition4->setArme($manager->getRepository(Arme::class)->findOneBy(array('name' => 'Epée')));
            $competition4->setCategorie($manager->getRepository(CategorieAge::class)->findOneBy(array('name' => 'M11')));
            $competition4->setHandisport(false);
            $competition4->setJourCompetition($jourCompet1);
            $competition4->addCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Homme')));
            $competition4->addCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Femme')));

            $competition5 = new Competition();
            $competition5->setBlason($manager->getRepository(Blason::class)->findOneBy(array('grade' => 'Blason Jaune')));
            $competition5->setArme($manager->getRepository(Arme::class)->findOneBy(array('name' => 'Epée')));
            $competition5->setCategorie($manager->getRepository(CategorieAge::class)->findOneBy(array('name' => 'M20')));
            $competition5->setHandisport(false);
            $competition5->setJourCompetition($jourCompet1);
            $competition5->addCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Homme')));
            $competition5->addCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Femme')));

            $competition6 = new Competition();
            $competition6->setBlason($manager->getRepository(Blason::class)->findOneBy(array('grade' => 'Blason Jaune')));
            $competition6->setArme($manager->getRepository(Arme::class)->findOneBy(array('name' => 'Epée')));
            $competition6->setCategorie($manager->getRepository(CategorieAge::class)->findOneBy(array('name' => 'Séniors')));
            $competition6->setHandisport(false);
            $competition6->setJourCompetition($jourCompet1);
            $competition6->addCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Homme')));
            $competition6->addCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Femme')));

            $competition7 = new Competition();
            $competition7->setBlason($manager->getRepository(Blason::class)->findOneBy(array('grade' => 'Blason Jaune')));
            $competition7->setArme($manager->getRepository(Arme::class)->findOneBy(array('name' => 'Epée')));
            $competition7->setCategorie($manager->getRepository(CategorieAge::class)->findOneBy(array('name' => 'Séniors')));
            $competition7->setHandisport(false);
            $competition7->setJourCompetition($jourCompet1);
            $competition7->addCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Homme')));
            $competition7->addCiv($manager->getRepository(Civ::class)->findOneBy(array('name' => 'Femme')));


            $manager->persist($jourCompet1);
            $manager->persist($competition1);
            $manager->persist($competition2);
            $manager->persist($competition3);
            $manager->persist($competition4);
            $manager->persist($competition5);
            $manager->persist($competition6);

        }

        $manager->flush();
    }
}
