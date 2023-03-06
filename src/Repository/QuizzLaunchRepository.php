<?php

namespace App\Repository;

use App\Entity\QuizzLaunch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuizzLaunch>
 *
 * @method QuizzLaunch|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizzLaunch|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizzLaunch[]    findAll()
 * @method QuizzLaunch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizzLaunchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizzLaunch::class);
    }

    public function save(QuizzLaunch $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(QuizzLaunch $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return QuizzLaunch[] Returns an array of QuizzLaunch objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('q.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?QuizzLaunch
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
