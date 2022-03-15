<?php

namespace App\Repository;

use App\Entity\Membre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Membre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Membre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Membre[]    findAll()
 * @method Membre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MembreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Membre::class);
    }

    // /**
    //  * @return Membre[] Returns an array of Membre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Membre
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getEffectifByCellule($fromDate = null, $toDate = null)
    {
        $qb = $this->createQueryBuilder('m')
            ->select('c.id, c.name, COUNT(c.id) AS count')
            ->join('m.cellule', 'c');
        $params = null;
        if ($fromDate) {
            $params = [
                "fromDate" => new \DateTime($fromDate),
            ];
            $qb->where('m.subscriptionDate >= :fromDate');
        }
        if ($toDate) {
            $params["toDate"] = new \DateTime($toDate);
            $qb->andWhere('m.subscriptionDate >= :fromDate');
        }
        $qb->groupBy('c.id');
        return $qb->getQuery()->execute($params);
    }

    public function getStats()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT c.name, COUNT(c.id) FROM membre m INNER JOIN cellule c ON m.cellule_id = c.id
            WHERE m.subscriptionDate > :price
            GROUP BY c.id
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['price' => $price]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }
}
