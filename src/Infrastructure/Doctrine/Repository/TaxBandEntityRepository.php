<?php

namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\Repository\TaxBandRepositoryInterface;
use App\Infrastructure\Doctrine\Entity\TaxBandEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TaxBandEntity>
 */
class TaxBandEntityRepository extends ServiceEntityRepository implements TaxBandRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaxBandEntity::class);
    }
    public function findAll(): array
    {
        $list = parent::findAll();
        return array_map(fn(TaxBandEntity $entity) => $entity->toDomain(), $list);
    }
    //    /**
    //     * @return TaxBandEntity[] Returns an array of TaxBandEntity objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?TaxBandEntity
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
