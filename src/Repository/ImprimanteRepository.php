<?php

namespace App\Repository;

use App\Entity\Imprimante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Imprimante|null find($id, $lockMode = null, $lockVersion = null)
 * @method Imprimante|null findOneBy(array $criteria, array $orderBy = null)
 * @method Imprimante[]    findAll()
 * @method Imprimante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImprimanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Imprimante::class);
    }

    // /**
    //  * @return Imprimante[] Returns an array of Imprimante objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Imprimante
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
