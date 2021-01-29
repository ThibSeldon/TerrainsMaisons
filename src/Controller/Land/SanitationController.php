<?php

namespace App\Controller\Land;

use App\Entity\Land\Sanitation;
use App\Form\Land\SanitationType;
use App\Repository\Land\SanitationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cc/land/sanitation')]
class SanitationController extends AbstractController
{
    #[Route('/', name: 'land_sanitation_index', methods: ['GET'])]
    public function index(SanitationRepository $sanitationRepository): Response
    {
        return $this->render('land/sanitation/index.html.twig', [
            'sanitations' => $sanitationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'land_sanitation_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $sanitation = new Sanitation();
        $form = $this->createForm(SanitationType::class, $sanitation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sanitation);
            $entityManager->flush();

            return $this->redirectToRoute('land_sanitation_index');
        }

        return $this->render('land/sanitation/new.html.twig', [
            'sanitation' => $sanitation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'land_sanitation_show', methods: ['GET'])]
    public function show(Sanitation $sanitation): Response
    {
        return $this->render('land/sanitation/show.html.twig', [
            'sanitation' => $sanitation,
        ]);
    }

    #[Route('/{id}/edit', name: 'land_sanitation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sanitation $sanitation): Response
    {
        $form = $this->createForm(SanitationType::class, $sanitation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('land_sanitation_index');
        }

        return $this->render('land/sanitation/edit.html.twig', [
            'sanitation' => $sanitation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'land_sanitation_delete', methods: ['DELETE'])]
    public function delete(Request $request, Sanitation $sanitation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sanitation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sanitation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('land_sanitation_index');
    }
}
