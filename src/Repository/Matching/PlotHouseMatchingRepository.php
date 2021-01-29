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

    public function findByHouseBedroom($plot, $bedRoom, $houseBrand, $budgetMax)
    {
        $qb = $this->createQueryBuilder('m');
            $qb->join('m.house', 'h');

            $qb
                ->andWhere('m.plot = :plot')
                ->setParameter('plot', $plot);

            if($bedRoom){
            $qb
                ->andWhere('h.roomNumber = :bedroom')
                ->setParameter('bedroom', $bedRoom);
            }

            if($houseBrand){
                $qb
                    ->andWhere('h.houseBrand = :brand')
                    ->setParameter('brand', $houseBrand);
            }

            if($budgetMax){
                $qb
                    ->andWhere('m.sellingPriceAti <= :budgetMax')
                    ->setParameter('budgetMax', $budgetMax);
            }

            return $qb
                ->orderBy('m.sellingPriceAti', 'ASC')
                ->getQuery()
                ->execute();


    }

    public function findByBudget($budget)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.sellingPriceAti <= :budget')
            ->setParameters([
                'budget'=>$budget
            ])
            ->orderBy('m.updatedAt', 'ASC')
            ->setMaxResults(50)
            ->getQuery()
            ->getResult()
            ;
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
