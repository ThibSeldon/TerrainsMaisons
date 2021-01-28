<?php

namespace App\Repository\Land;

use App\Entity\Land\Sanitation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sanitation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sanitation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sanitation[]    findAll()
 * @method Sanitation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SanitationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sanitation::class);
    }

    // /**
    //  * @return Sanitation[] Returns an array of Sanitation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sanitation
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
