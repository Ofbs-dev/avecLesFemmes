<?php

namespace App\Controller;

use App\Repository\GroupementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GroupementController extends AbstractController
{
    #[Route('/groupement', name: 'app_groupement', methods: ['GET'])]
    public function index(GroupementRepository $repository): Response
    {
        return $this->render('groupement/index.html.twig', [
            'groupements' => $repository->findAll(),
        ]);
    }
}