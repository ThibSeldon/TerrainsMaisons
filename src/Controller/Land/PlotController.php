<?php

namespace App\Controller\Land;

use App\Entity\Land\Plot;
use App\Form\Land\PlotType;
use App\Repository\HouseRepository;
use App\Repository\Land\PlotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/land/plot")
 */
class PlotController extends AbstractController
{
    /**
     * @Route("/", name="land_plot_index", methods={"GET"})
     */
    public function index(PlotRepository $plotRepository): Response
    {
        return $this->render('land/plot/index.html.twig', [
            'plots' => $plotRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="land_plot_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $plot = new Plot();
        $form = $this->createForm(PlotType::class, $plot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($plot);
            $entityManager->flush();

            return $this->redirectToRoute('land_plot_index');
        }

        return $this->render('land/plot/new.html.twig', [
            'plot' => $plot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="land_plot_show", methods={"GET"})
     * @param Plot $plot
     * @param HouseRepository $houseRepository
     * @return Response
     */
    public function show(Plot $plot, HouseRepository $houseRepository): Response
    {
        $plotWidth = $plot->getFacadeWidth();

        $propertyLimit = $plot->getAllotment()->getPropertyLimit();
        $plotWidth -= $propertyLimit;



        $houses = $houseRepository->findByLength($plotWidth);
        return $this->render('land/plot/show.html.twig', [
            'plot' => $plot,
            'houses' => $houses,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="land_plot_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Plot $plot): Response
    {
        $form = $this->createForm(PlotType::class, $plot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('land_plot_index');
        }

        return $this->render('land/plot/edit.html.twig', [
            'plot' => $plot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="land_plot_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Plot $plot): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plot->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($plot);
            $entityManager->flush();
        }

        return $this->redirectToRoute('land_plot_index');
    }
}
