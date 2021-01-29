<?php

namespace App\Controller\Land;

use App\Entity\Land\AllotmentState;
use App\Form\Land\AllotmentStateType;
use App\Repository\Land\AllotmentStateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cc/land/allotment/state')]
class AllotmentStateController extends AbstractController
{
    #[Route('/', name: 'land_allotment_state_index', methods: ['GET'])]
    public function index(AllotmentStateRepository $allotmentStateRepository): Response
    {
        return $this->render('land/allotment_state/index.html.twig', [
            'allotment_states' => $allotmentStateRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'land_allotment_state_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $allotmentState = new AllotmentState();
        $form = $this->createForm(AllotmentStateType::class, $allotmentState);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($allotmentState);
            $entityManager->flush();

            return $this->redirectToRoute('land_allotment_state_index');
        }

        return $this->render('land/allotment_state/new.html.twig', [
            'allotment_state' => $allotmentState,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'land_allotment_state_show', methods: ['GET'])]
    public function show(AllotmentState $allotmentState): Response
    {
        return $this->render('land/allotment_state/show.html.twig', [
            'allotment_state' => $allotmentState,
        ]);
    }

    #[Route('/{id}/edit', name: 'land_allotment_state_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AllotmentState $allotmentState): Response
    {
        $form = $this->createForm(AllotmentStateType::class, $allotmentState);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('land_allotment_state_index');
        }

        return $this->render('land/allotment_state/edit.html.twig', [
            'allotment_state' => $allotmentState,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'land_allotment_state_delete', methods: ['DELETE'])]
    public function delete(Request $request, AllotmentState $allotmentState): Response
    {
        if ($this->isCsrfTokenValid('delete'.$allotmentState->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($allotmentState);
            $entityManager->flush();
        }

        return $this->redirectToRoute('land_allotment_state_index');
    }
}
