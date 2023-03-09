<?php

namespace App\Repository;

use App\Entity\QuizLaunchParticipant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuizLaunchParticipant>
 *
 * @method QuizLaunchParticipant|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizLaunchParticipant|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizLaunchParticipant[]    findAll()
 * @method QuizLaunchParticipant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizLaunchParticipantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizLaunchParticipant::class);
    }

    public function save(QuizLaunchParticipant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(QuizLaunchParticipant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return QuizLaunchParticipant[] Returns an array of QuizLaunchParticipant objects
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

//    public function findOneBySomeField($value): ?QuizLaunchParticipant
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
