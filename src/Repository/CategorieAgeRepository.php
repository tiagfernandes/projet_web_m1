<?php

namespace App\Repository;

use App\Entity\CategorieAge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CategorieAge|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieAge|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieAge[]    findAll()
 * @method CategorieAge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieAgeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CategorieAge::class);
    }

    // /**
    //  * @return CategorieAge[] Returns an array of CategorieAge objects
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
    public function findOneBySomeField($value): ?CategorieAge
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
