<?php

namespace App\Repository;

use App\Entity\QuizzLaunchParticipant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuizzLaunchParticipant>
 *
 * @method QuizzLaunchParticipant|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizzLaunchParticipant|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizzLaunchParticipant[]    findAll()
 * @method QuizzLaunchParticipant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizzLaunchParticipantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizzLaunchParticipant::class);
    }

    public function save(QuizzLaunchParticipant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(QuizzLaunchParticipant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return QuizzLaunchParticipant[] Returns an array of QuizzLaunchParticipant objects
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

//    public function findOneBySomeField($value): ?QuizzLaunchParticipant
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
