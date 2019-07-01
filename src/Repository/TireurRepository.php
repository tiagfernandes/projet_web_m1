<?php

namespace App\Repository;

use App\Entity\Tireur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tireur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tireur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tireur[]    findAll()
 * @method Tireur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TireurRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tireur::class);
    }

    // /**
    //  * @return Tireur[] Returns an array of Tireur objects
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
    public function findOneBySomeField($value): ?Tireur
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
