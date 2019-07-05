<?php

namespace App\Repository;

use App\Entity\Entrainement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Entrainement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entrainement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entrainement[]    findAll()
 * @method Entrainement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrainementRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Entrainement::class);
    }

    // /**
    //  * @return Entrainement[] Returns an array of Entrainement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Entrainement
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAllByDate()
    {
        return $this->findBy(
            [],
            ['dateTimeStart' => 'ASC']
        );
    }

    public function findByDate()
    {
//        $dateStart = date_add(new \DateTime(), date_interval_create_from_date_string('-1 hours'));
//        $dateEnd = date_add(new \DateTime(), date_interval_create_from_date_string('1 hours'));
        $dateStart = date_add(new \DateTime(), date_interval_create_from_date_string('-1 days'));
        $dateEnd = date_add(new \DateTime(), date_interval_create_from_date_string('1 days'));

        return $this->createQueryBuilder('entrainement')
            ->andWhere('entrainement.dateTimeStart BETWEEN :dateStart AND :dateEnd')
            ->setParameters(array(
                'dateStart' => $dateStart,
                'dateEnd' => $dateEnd
            ))
            ->orderBy('entrainement.dateTimeStart', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findMine($user) {
        return $this->createQueryBuilder('entrainement')
            ->join('entrainement.entrainementTireurs', 'et')
            ->andWhere('et.present = true')
            ->andWhere('et.tireur = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }
}
