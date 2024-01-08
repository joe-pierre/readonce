<?php

namespace App\Repository;

use App\Entity\ReadonceMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReadonceMessage>
 *
 * @method ReadonceMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReadonceMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReadonceMessage[]    findAll()
 * @method ReadonceMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReadonceMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReadonceMessage::class);
    }

//    /**
//     * @return ReadonceMessage[] Returns an array of ReadonceMessage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ReadonceMessage
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
