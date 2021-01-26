<?php

namespace App\Repository\Land;

use App\Entity\Land\AllotmentState;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AllotmentState|null find($id, $lockMode = null, $lockVersion = null)
 * @method AllotmentState|null findOneBy(array $criteria, array $orderBy = null)
 * @method AllotmentState[]    findAll()
 * @method AllotmentState[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AllotmentStateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AllotmentState::class);
    }

    // /**
    //  * @return AllotmentState[] Returns an array of AllotmentState objects
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
    public function findOneBySomeField($value): ?AllotmentState
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
