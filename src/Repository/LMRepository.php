<?php

namespace App\Repository;

use App\Entity\LM;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LM|null find($id, $lockMode = null, $lockVersion = null)
 * @method LM|null findOneBy(array $criteria, array $orderBy = null)
 * @method LM[]    findAll()
 * @method LM[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LMRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LM::class);
    }

    // /**
    //  * @return LM[] Returns an array of LM objects
    //  */
    
    public function findByName($name_entreprise)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.name_entreprise = :name_entreprise')
            ->setParameter('name_entreprise', $name_entreprise)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?LM
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
