<?php

namespace App\Repository\Matching;

use App\Entity\Matching\PlotHouseMatching;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlotHouseMatching|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlotHouseMatching|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlotHouseMatching[]    findAll()
 * @method PlotHouseMatching[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlotHouseMatchingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlotHouseMatching::class);
    }

    // /**
    //  * @return PlotHouseMatching[] Returns an array of PlotHouseMatching objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlotHouseMatching
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
