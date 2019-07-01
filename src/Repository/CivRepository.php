<?php

namespace App\Repository;

use App\Entity\Civ;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Civ|null find($id, $lockMode = null, $lockVersion = null)
 * @method Civ|null findOneBy(array $criteria, array $orderBy = null)
 * @method Civ[]    findAll()
 * @method Civ[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CivRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Civ::class);
    }

    // /**
    //  * @return Civ[] Returns an array of Civ objects
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
    public function findOneBySomeField($value): ?Civ
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
