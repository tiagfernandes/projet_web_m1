<?php

namespace App\Repository;

use App\Entity\Competition;
use App\Entity\Inscription;
use App\Entity\Tireur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Inscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method Inscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method Inscription[]    findAll()
 * @method Inscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscriptionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Inscription::class);
    }


    public function findByUser(Tireur $user)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.tireur = :user')
            ->setParameter('user', $user)
            ->getQuery();
    }

    public function findOneByComptetitonAndUser(Competition $competition, $user)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.tireur = :user')
            ->setParameter('user', $user)
            ->andWhere('i.competition = :competition')
            ->setParameter('competition', $competition)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findWithClassementByUser($user)
    {
        $qb = $this->createQueryBuilder('i')
            ->andWhere('i.tireur = :user')
            ->setParameter('user', $user);
        $qb
            ->andWhere($qb->expr()->isNotNull('i.classement'));

        return $qb->getQuery()->getResult();
    }

    // /**
    //  * @return Inscription[] Returns an array of Inscription objects
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
    public function findOneBySomeField($value): ?Inscription
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
