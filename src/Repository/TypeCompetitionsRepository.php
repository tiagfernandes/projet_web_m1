<?php

namespace App\Repository;

use App\Entity\TypeCompetitions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeCompetitions|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeCompetitions|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeCompetitions[]    findAll()
 * @method TypeCompetitions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeCompetitionsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeCompetitions::class);
    }

    // /**
    //  * @return TypeCompetitions[] Returns an array of TypeCompetitions objects
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
    public function findOneBySomeField($value): ?TypeCompetitions
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
