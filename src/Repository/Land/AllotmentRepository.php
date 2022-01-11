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


    public function findBySearchForm($values)
    {
        $cities = [];
        foreach ($values as $val) {
            $cities[] = $val->getCity();
        }

        $qb = $this->createQueryBuilder('a');
        $qb->andWhere('a.isValid = true')
            ->andWhere('a.city IN (:cities)')
            ->setParameter(':cities', $cities);

        return $qb->orderBy('a.city', 'ASC')
            ->getQuery()
            ->execute();
    }

    public function findAllotmentByRoofing($roofing)
    {
        $qb = $this->createQueryBuilder('a');

        return $qb
            ->join('a.houseRoofings', 'r')
            ->andWhere('r.name = :roofing')
            ->andWhere('a.isValid = true')
            ->setParameter('roofing', $roofing)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByHouse($house){
        $qb = $this->createQueryBuilder('a');

        return $qb
            ->join('a.plots', 'p')
            ->join('p.plotHouseMatchings', 'm')
            ->andWhere('m.house = :house')
            ->setParameter('house', $house)
            ->orderBy('a.city', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByMatch($matchs){
        $qb = $this->createQueryBuilder('a');

        return $qb
            ->join('a.plots', 'p')
            ->join('p.plotHouseMatchings', 'm')
            ->andWhere('m IN (:matchs)')
            ->setParameter('matchs', $matchs)
            ->getQuery()
            ->getResult()
            ;
    }

}
