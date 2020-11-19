<?php

namespace App\Controller;

use App\Entity\House;
use App\Form\HouseType;
use App\Form\House\HouseSearchType;
use App\Repository\HouseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/house")
 */
class HouseController extends AbstractController
{
    /**
     * @Route("/", name="house_index", methods={"GET"})
     */
    public function index(HouseRepository $houseRepository): Response
    {
        return $this->render('house/index.html.twig', [
            'houses' => $houseRepository->findAll(),
        ]);
    }


    /**
     * @Route("/search", name="house_search")
     */
    public function searchHouse(Request $request, HouseRepository $houseRepository): Response
    {
        $searchForm = $this->createForm(HouseSearchType::class);
        $searchForm->handleRequest($request);
        
        if($searchForm->isSubmitted() && $searchForm->isValid())
        {
            $data = $searchForm->getData()->getType();
            
            $model = $houseRepository->searchByName($data);
            dump($model);

        }
        else {
        $model = $houseRepository->findAll();
        }

        return $this->render('house/index.html.twig', [
            'houses' => $model,
            'form' => $searchForm->createView(),
        ]);

    }


    /**
     * @Route("/new", name="house_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $house = new House();
        $form = $this->createForm(HouseType::class, $house);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($house);
            $entityManager->flush();

            return $this->redirectToRoute('house_index');
        }

        return $this->render('house/new.html.twig', [
            'house' => $house,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="house_show", methods={"GET"})
     */
    public function show(House $house): Response
    {
        return $this->render('house/show.html.twig', [
            'house' => $house,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="house_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, House $house): Response
    {
        $form = $this->createForm(HouseType::class, $house);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('house_index');
        }

        return $this->render('house/edit.html.twig', [
            'house' => $house,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="house_delete", methods={"DELETE"})
     */
    public function delete(Request $request, House $house): Response
    {
        if ($this->isCsrfTokenValid('delete'.$house->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($house);
            $entityManager->flush();
        }

        return $this->redirectToRoute('house_index');
    }
}
