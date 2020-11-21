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


    public function searchByName($dataAll)
    {


        $name = $dataAll->getName();
        $houseModel = $dataAll->getHouseModel();
        $houseBrand = $dataAll->gethouseBrand();
        $roomNumber = $dataAll->getRoomNumber();
        $priceMax = $dataAll->getSellingPriceAti();
        $length = $dataAll->getLength();
        $valid = $dataAll->getValid();       

        $qb = $this->createQueryBuilder('h');

        if (isset($name)) {
            return $qb->andwhere('h.name LIKE :name')
                ->setParameter(':name', '%' . $name . '%')
                ->orderBy('h.name', 'ASC')
                ->getQuery()
                ->execute();
        }

        if (isset($houseModel)) {
            $qb->andwhere('h.houseModel = :houseModel')
                ->setParameter(':houseModel', $houseModel);
        }

        if (isset($houseBrand)) {
            $qb->andwhere('h.houseBrand = :houseBrand')
                ->setParameter(':houseBrand', $houseBrand);
        }
        if (isset($roomNumber)) {
                      
            $qb->andwhere('h.roomNumber = :roomNumber')
                ->setParameter(':roomNumber', $roomNumber);
        }
        if (isset($priceMax)) {
            $qb->andwhere('h.sellingPriceAti <= :priceMax')
                ->setParameter(':priceMax', $priceMax);
        }
        if (isset($length)) {
            $qb->andwhere('h.length = :length')
                ->setParameter(':length', $length);
        }
        if(isset($valid)) {
            $qb->andWhere('h.valid = :valid')
                ->setParameter(':valid', $valid);
        }
       
        return $qb->orderBy('h.name', 'ASC')
            ->getQuery()
            ->execute();
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
