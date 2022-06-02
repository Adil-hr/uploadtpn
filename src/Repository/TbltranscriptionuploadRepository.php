<?php

namespace App\Repository;

use App\Entity\Tbltranscriptionupload;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tbltranscriptionupload>
 *
 * @method Tbltranscriptionupload|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tbltranscriptionupload|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tbltranscriptionupload[]    findAll()
 * @method Tbltranscriptionupload[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TbltranscriptionuploadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tbltranscriptionupload::class);
    }

    public function add(Tbltranscriptionupload $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Tbltranscriptionupload $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Tbltranscriptionupload[] Returns an array of Tbltranscriptionupload objects
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

//    public function findOneBySomeField($value): ?Tbltranscriptionupload
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
