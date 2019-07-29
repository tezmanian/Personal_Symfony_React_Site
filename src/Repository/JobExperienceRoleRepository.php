<?php

namespace App\Repository;

use App\Entity\JobExperienceRole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method JobExperienceRole|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobExperienceRole|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobExperienceRole[]    findAll()
 * @method JobExperienceRole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobExperienceRoleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, JobExperienceRole::class);
    }

    // /**
    //  * @return JobExperienceRole[] Returns an array of JobExperienceRole objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JobExperienceRole
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
