<?php

namespace App\Repository;

use App\Entity\MaitreArmes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MaitreArmes|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaitreArmes|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaitreArmes[]    findAll()
 * @method MaitreArmes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaitreArmesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MaitreArmes::class);
    }

    // /**
    //  * @return MaitreArmes[] Returns an array of MaitreArmes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MaitreArmes
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
