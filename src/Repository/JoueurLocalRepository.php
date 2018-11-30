<?php

namespace App\Repository;

use App\Entity\JoueurLocal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method JoueurLocal|null find($id, $lockMode = null, $lockVersion = null)
 * @method JoueurLocal|null findOneBy(array $criteria, array $orderBy = null)
 * @method JoueurLocal[]    findAll()
 * @method JoueurLocal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JoueurLocalRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, JoueurLocal::class);
    }

    /**
     * @return JoueurLocal[] Returns an array of JoueurLocal objects
     */
    
    public function findByPartiePlayer($partie)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.partie = :val')
            ->setParameter('val', $partie)
            ->orderBy('j.ordre', 'ASC')
            /* ->getQuery()
            ->getResult() */
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?JoueurLocal
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
