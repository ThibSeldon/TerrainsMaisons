<?php

namespace App\Repository\Admin\House;

use App\Entity\Admin\House\HouseRoofing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HouseRoofing|null find($id, $lockMode = null, $lockVersion = null)
 * @method HouseRoofing|null findOneBy(array $criteria, array $orderBy = null)
 * @method HouseRoofing[]    findAll()
 * @method HouseRoofing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HouseRoofingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HouseRoofing::class);
    }

    // /**
    //  * @return HouseRoofing[] Returns an array of HouseRoofing objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HouseRoofing
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
