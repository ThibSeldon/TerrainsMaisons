<?php

namespace App\Controller\Admin\House;

use App\Entity\Admin\House\HouseRoofing;
use App\Form\Admin\House\HouseRoofingType;
use App\Repository\Admin\House\HouseRoofingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cc/admin/house/house/roofing")
 */
class HouseRoofingController extends AbstractController
{
    /**
     * @Route("/", name="admin_house_house_roofing_index", methods={"GET"})
     */
    public function index(HouseRoofingRepository $houseRoofingRepository): Response
    {
        return $this->render('admin/house/house_roofing/index.html.twig', [
            'house_roofings' => $houseRoofingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_house_house_roofing_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $houseRoofing = new HouseRoofing();
        $form = $this->createForm(HouseRoofingType::class, $houseRoofing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($houseRoofing);
            $entityManager->flush();

            return $this->redirectToRoute('admin_house_house_roofing_index');
        }

        return $this->render('admin/house/house_roofing/new.html.twig', [
            'house_roofing' => $houseRoofing,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_house_house_roofing_show", methods={"GET"})
     */
    public function show(HouseRoofing $houseRoofing): Response
    {
        return $this->render('admin/house/house_roofing/show.html.twig', [
            'house_roofing' => $houseRoofing,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_house_house_roofing_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, HouseRoofing $houseRoofing): Response
    {
        $form = $this->createForm(HouseRoofingType::class, $houseRoofing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_house_house_roofing_index');
        }

        return $this->render('admin/house/house_roofing/edit.html.twig', [
            'house_roofing' => $houseRoofing,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_house_house_roofing_delete", methods={"DELETE"})
     */
    public function delete(Request $request, HouseRoofing $houseRoofing): Response
    {
        if ($this->isCsrfTokenValid('delete'.$houseRoofing->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($houseRoofing);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_house_house_roofing_index');
    }
}
