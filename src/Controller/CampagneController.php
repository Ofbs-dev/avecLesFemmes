<?php

namespace App\Controller;

use App\Entity\Campagne;
use App\Form\CampagneType;
use App\Repository\CampagneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/campagne')]
final class CampagneController extends AbstractController
{
    #[Route('/', name: 'app_campagne', methods: ['GET'])]
    public function index(CampagneRepository $repository): Response
    {
        return $this->render('campagne/index.html.twig', [
            'campagnes' => $repository->findBy([], ['id' => 'DESC']),
        ]);
    }

    #[Route('/ajouter', name: 'app_campagne_ajouter', methods: ['GET', 'POST'])]
    public function ajouter(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $campagne = new Campagne();
        $form = $this->createForm(CampagneType::class, $campagne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($campagne);
            $entityManager->flush();

            $this->addFlash('success', 'Campagne ajoutée avec succès.');

            return $this->redirectToRoute('app_campagne');
        }

        return $this->render('campagne/ajouter.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_campagne_detail', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function detail(Campagne $campagne): Response
    {
        return $this->render('campagne/detail.html.twig', [
            'campagne' => $campagne,
        ]);
    }

    #[Route('/{id}/modifier', name: 'app_campagne_modifier', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function modifier(
        Campagne $campagne,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(CampagneType::class, $campagne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Campagne modifiée avec succès.');

            return $this->redirectToRoute('app_campagne');
        }

        return $this->render('campagne/modifier.html.twig', [
            'form' => $form,
            'campagne' => $campagne,
        ]);
    }

    #[Route('/{id}/supprimer', name: 'app_campagne_supprimer', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function supprimer(
        Campagne $campagne,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        if ($this->isCsrfTokenValid(
            'supprimer_campagne_' . $campagne->getId(),
            $request->request->get('_token')
        )) {
            $entityManager->remove($campagne);
            $entityManager->flush();

            $this->addFlash('success', 'Campagne supprimée avec succès.');
        }

        return $this->redirectToRoute('app_campagne');
    }
}
