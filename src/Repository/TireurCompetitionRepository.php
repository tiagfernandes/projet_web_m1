<?php

namespace App\Repository;

use App\Entity\TireurCompetition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TireurCompetition|null find($id, $lockMode = null, $lockVersion = null)
 * @method TireurCompetition|null findOneBy(array $criteria, array $orderBy = null)
 * @method TireurCompetition[]    findAll()
 * @method TireurCompetition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TireurCompetitionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TireurCompetition::class);
    }

    // /**
    //  * @return TireurCompetition[] Returns an array of TireurCompetition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TireurCompetition
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
