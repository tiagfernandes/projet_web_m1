<?php

namespace App\Repository;

use App\Entity\NiveauArbitrage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NiveauArbitrage|null find($id, $lockMode = null, $lockVersion = null)
 * @method NiveauArbitrage|null findOneBy(array $criteria, array $orderBy = null)
 * @method NiveauArbitrage[]    findAll()
 * @method NiveauArbitrage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NiveauArbitrageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NiveauArbitrage::class);
    }

    // /**
    //  * @return NiveauArbitrage[] Returns an array of NiveauArbitrage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NiveauArbitrage
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
