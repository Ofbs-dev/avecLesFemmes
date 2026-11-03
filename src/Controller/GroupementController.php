<?php

namespace App\Controller;

use App\DTO\GroupementFilterInput;
use App\Form\GroupementFilterType;
use App\Service\GroupementService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GroupementController extends AbstractController
{
    #[Route('/groupement', name: 'app_groupement', methods: ['GET'])]
    public function index(
        Request $request,
        GroupementService $groupementService
    ): Response {
        // Création du DTO de filtrage
        $filter = new GroupementFilterInput();

        // Création et traitement du formulaire
        $form = $this->createForm(GroupementFilterType::class, $filter);
        $form->handleRequest($request);

        // Récupération de la page demandée
        $filter->page = max(1, $request->query->getInt('page', 1));

        // Récupération des groupements via le service
        $result = $groupementService->getGroupements($filter);

        return $this->render('groupement/index.html.twig', [
            'form' => $form->createView(),
            'groupements' => $result->groupements,
            'result' => $result,
        ]);
    }
}