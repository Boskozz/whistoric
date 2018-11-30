<?php

namespace App\Repository;

use App\Entity\ContratConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ContratConfig|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContratConfig|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContratConfig[]    findAll()
 * @method ContratConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContratConfigRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ContratConfig::class);
    }

    // /**
    //  * @return ContratConfig[] Returns an array of ContratConfig objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContratConfig
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
