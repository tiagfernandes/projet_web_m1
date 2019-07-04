<?php

namespace App\Repository;

use App\Entity\Tireur;
use App\Entity\Competition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Competition|null find($id, $lockMode = null, $lockVersion = null)
 * @method Competition|null findOneBy(array $criteria, array $orderBy = null)
 * @method Competition[]    findAll()
 * @method Competition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompetitionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Competition::class);
    }

    public function findEnableByUser(Tireur $user)
    {
        $qb = $this->createQueryBuilder('c')
            ->andWhere('c.categorie = :categorie')
            ->setParameter('categorie', $user->getCategorieAge($this->getEntityManager()))
            ->andWhere(':civ MEMBER OF c.civ')
            ->setParameter('civ', $user->getCiv())
            ->andWhere('c.arme = :arme')
            ->setParameter('arme', $user->getArme())
            ->join('c.inscription', 'inscription')
            ->andWhere('inscription.tireur != :user')
            ->setParameter('user', $user)
//            ->andWhere('c.dateTimeStart > :now')
//            ->setParameter('now', new \DateTime())
//            ->andWhere(':user NOT MEMBER OF tc.tireurs')
//            ->setParameter('user', $user)
//            ->andWhere('tc.arme = :arme')
//            ->setParameter('arme', $user->getArme())
//            ->andWhere(':civ MEMBER OF tc.civ')
//            ->setParameter('civ', $user->geiiv())
//            ->andWhere('tc.categorie = :categorie')
//            ->setParameter('categorie', $user->getCategorieAge($this->getEntityManager()))
            ->getQuery();

        return $qb->getResult();
    }

    public function findByUser(Tireur $user)
    {
        return $this->createQueryBuilder('c')
            ->join('c.inscription', 'inscription')
            ->andWhere('inscription.tireur = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Competition[] Returns an array of Competition objects
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
    public function findOneBySomeField($value): ?Competition
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
