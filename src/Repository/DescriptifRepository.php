<?php

namespace App\Repository;

use App\Entity\Descriptif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Descriptif|null find($id, $lockMode = null, $lockVersion = null)
 * @method Descriptif|null findOneBy(array $criteria, array $orderBy = null)
 * @method Descriptif[]    findAll()
 * @method Descriptif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DescriptifRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Descriptif::class);
    }

    // /**
    //  * @return Descriptif[] Returns an array of Descriptif objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Descriptif
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
