<?php

namespace App\Service;

use App\DTO\GroupementFilterInput;
use App\DTO\GroupementListOutput;
use App\Repository\GroupementRepository;

class GroupementService
{
    public function __construct(
        private GroupementRepository $groupementRepository
    ) {
    }

    public function getGroupements(
        GroupementFilterInput $filter
    ): GroupementListOutput {

        // Vérification des paramètres de pagination
        $filter->page = max(1, $filter->page);
        $filter->limit = max(1, $filter->limit);

        // Récupération des résultats filtrés et paginés
        $result = $this->groupementRepository->findFiltered($filter);

        // Création du DTO de sortie
        return new GroupementListOutput(
            $result['groupements'],
            $filter->page,
            $filter->limit,
            $result['total']
        );
    }
}
