<?php

namespace App\Repository\Admin\House;

use App\Entity\Admin\House\HouseModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HouseModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method HouseModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method HouseModel[]    findAll()
 * @method HouseModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HouseModelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HouseModel::class);
    }

    // /**
    //  * @return HouseModel[] Returns an array of HouseModel objects
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
    public function findOneBySomeField($value): ?HouseModel
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
