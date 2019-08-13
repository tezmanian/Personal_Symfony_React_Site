<?php

namespace App\Repository;

use App\Entity\AboutItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AboutItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method AboutItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method AboutItem[]    findAll()
 * @method AboutItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AboutItemRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AboutItem::class);
    }
    
    /**
     * @param int $offset
     * @return mixed
     */
    public function findOneByOffset(int $offset)
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.year', 'ASC')
            ->setFirstResult($offset)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    // /**
    //  * @return AboutItem[] Returns an array of AboutItem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AboutItem
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
