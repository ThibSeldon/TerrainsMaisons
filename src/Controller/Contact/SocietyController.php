<?php

namespace App\Controller\Contact;

use App\Entity\Contact\Society;
use App\Form\Contact\SocietyType;
use App\Repository\Contact\SocietyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact/society")
 */
class SocietyController extends AbstractController
{
    /**
     * @Route("/", name="contact_society_index", methods={"GET"})
     */
    public function index(SocietyRepository $societyRepository): Response
    {
        return $this->render('contact/society/index.html.twig', [
            'societies' => $societyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="contact_society_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $society = new Society();
        $form = $this->createForm(SocietyType::class, $society);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($society);
            $entityManager->flush();

            return $this->redirectToRoute('contact_society_index');
        }

        return $this->render('contact/society/new.html.twig', [
            'society' => $society,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contact_society_show", methods={"GET"})
     */
    public function show(Society $society): Response
    {
        return $this->render('contact/society/show.html.twig', [
            'society' => $society,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contact_society_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Society $society): Response
    {
        $form = $this->createForm(SocietyType::class, $society);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contact_society_index');
        }

        return $this->render('contact/society/edit.html.twig', [
            'society' => $society,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contact_society_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Society $society): Response
    {
        if ($this->isCsrfTokenValid('delete'.$society->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($society);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contact_society_index');
    }
}
