<?php

namespace App\Repository;

use App\Entity\Medicines;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Medicines|null find($id, $lockMode = null, $lockVersion = null)
 * @method Medicines|null findOneBy(array $criteria, array $orderBy = null)
 * @method Medicines[]    findAll()
 * @method Medicines[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicinesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Medicines::class);
    }

    // /**
    //  * @return Medicines[] Returns an array of Medicines objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Medicines
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
