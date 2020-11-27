<?php

namespace App\Repository\Land;

use App\Entity\Land\Allotment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Allotment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Allotment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Allotment[]    findAll()
 * @method Allotment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AllotmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Allotment::class);
    }

    // /**
    //  * @return Allotment[] Returns an array of Allotment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Allotment
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
