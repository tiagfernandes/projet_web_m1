<?php

namespace App\Repository;

use App\Entity\JourCompetition;
use App\Entity\Tireur;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;

/**
 * @method JourCompetition|null find($id, $lockMode = null, $lockVersion = null)
 * @method JourCompetition|null findOneBy(array $criteria, array $orderBy = null)
 * @method JourCompetition[]    findAll()
 * @method JourCompetition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JourCompetitionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, JourCompetition::class);
    }

    public function findEnableByUser(Tireur $user)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.dateTimeStart > :now')
            ->setParameter('now', new \DateTime())
            ->join('c.typeCompetitions', 'tc')
            ->andWhere(':user NOT MEMBER OF tc.tireurs')
            ->setParameter('user', $user)
            ->andWhere('tc.arme = :arme')
            ->setParameter('arme', $user->getArme())
            ->andWhere(':civ MEMBER OF tc.civ')
            ->setParameter('civ', $user->getCiv())
            ->andWhere('tc.categorie = :categorie')
            ->setParameter('categorie', $user->getCategorieAge($this->getEntityManager()))
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return JourCompetition[] Returns an array of JourCompetition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JourCompetition
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
