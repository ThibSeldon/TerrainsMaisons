<?php

namespace App\Repository;

use App\Entity\House;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method House|null find($id, $lockMode = null, $lockVersion = null)
 * @method House|null findOneBy(array $criteria, array $orderBy = null)
 * @method House[]    findAll()
 * @method House[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HouseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, House::class);
    }


    public function searchByName($modelType, $brand, $bedroom)
    {
        
        return $this->createQueryBuilder('h')
        ->andWhere('h.houseModel = :val')
        ->andwhere('h.houseBrand = :val2')
        ->andWhere('h.roomNumber = :val3')
        ->setParameter('val', $modelType)
        ->setParameter('val2', $brand)
        ->setParameter('val3', $bedroom)
        ->orderBy('h.name', 'ASC')
        ->getQuery()
        ->execute()
        ;
    }

    // /**
    //  * @return House[] Returns an array of House objects
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
    public function findOneBySomeField($value): ?House
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
