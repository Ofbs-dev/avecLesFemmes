<?php

namespace App\DTO;

use App\Entity\Groupement;

class GroupementListOutput
{
    /**
     * @param Groupement[] $groupements
     */
    public function __construct(
        public array $groupements,
        public int $page,
        public int $limit,
        public int $total
    ) {
    }

    public function getTotalPages(): int
    {
        return (int) ceil($this->total / $this->limit);
    }
}
