<?php

namespace App\Repository;

use App\Entity\Groupement;
use App\DTO\GroupementFilterInput;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GroupementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Groupement::class);
    }

    /**
     * @return array{groupements: Groupement[], total: int}
     */
    public function findFiltered(GroupementFilterInput $filter): array
    {
        $qb = $this->createQueryBuilder('g');

        if ($filter->tel !== null && trim($filter->tel) !== '') {
            $qb->andWhere('g.tel LIKE :tel')
                ->setParameter('tel', '%' . trim($filter->tel) . '%');
        }

        if ($filter->adresse !== null && trim($filter->adresse) !== '') {
            $qb->andWhere('g.adresse LIKE :adresse')
                ->setParameter('adresse', '%' . trim($filter->adresse) . '%');
        }

        // Nombre total de résultats
        $countQb = clone $qb;

        $total = (int) $countQb
            ->select('COUNT(g.id)')
            ->getQuery()
            ->getSingleScalarResult();

        // Pagination
        $page = max(1, $filter->page);
        $limit = max(1, $filter->limit);

        $groupements = $qb
            ->orderBy('g.id', 'ASC')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

        return [
            'groupements' => $groupements,
            'total' => $total,
        ];
    }
}
