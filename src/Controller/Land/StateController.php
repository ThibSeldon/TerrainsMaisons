<?php

namespace App\Controller\Land;

use App\Entity\Land\State;
use App\Form\Land\StateType;
use App\Repository\Land\StateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cc/land/state")
 */
class StateController extends AbstractController
{
    /**
     * @Route("/", name="land_state_index", methods={"GET"})
     */
    public function index(StateRepository $stateRepository): Response
    {
        return $this->render('land/state/index.html.twig', [
            'states' => $stateRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="land_state_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $state = new State();
        $form = $this->createForm(StateType::class, $state);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($state);
            $entityManager->flush();

            return $this->redirectToRoute('land_state_index');
        }

        return $this->render('land/state/new.html.twig', [
            'state' => $state,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="land_state_show", methods={"GET"})
     */
    public function show(State $state): Response
    {
        return $this->render('land/state/show.html.twig', [
            'state' => $state,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="land_state_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, State $state): Response
    {
        $form = $this->createForm(StateType::class, $state);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('land_state_index');
        }

        return $this->render('land/state/edit.html.twig', [
            'state' => $state,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="land_state_delete", methods={"DELETE"})
     */
    public function delete(Request $request, State $state): Response
    {
        if ($this->isCsrfTokenValid('delete'.$state->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($state);
            $entityManager->flush();
        }

        return $this->redirectToRoute('land_state_index');
    }
}
