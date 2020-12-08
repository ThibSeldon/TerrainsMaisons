<?php

namespace App\Controller;

use App\Entity\House;
use App\Entity\Land\Allotment;
use App\Entity\Land\Plot;
use App\Repository\HouseRepository;
use App\Repository\Land\AllotmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 * @Route("/home")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param HouseRepository $houseRepository
     * @param AllotmentRepository $allotmentRepository
     * @return Response
     */
    public function index(HouseRepository $houseRepository, AllotmentRepository $allotmentRepository): Response
    {

        $allotments = $allotmentRepository->findAll();

        return $this->render('home/index.html.twig', [

            'allotments' => $allotments,
        ]);
    }

    /**
     * @Route("/allotment/plot/{id}", name="all_plot_show")
     * @param Plot $plot
     * @param HouseRepository $houseRepository
     * @return Response
     */
    public function lot(Plot $plot, HouseRepository $houseRepository): Response
    {
        $houses = $houseRepository->findHousesPlotCompatible($plot->getFacadeWidth());

        return $this->render('home/plot_houses.html.twig', [
            'houses' => $houses,
            'plot' => $plot
        ]);
    }

    /**
     * @Route ("/allotment/{id}", name="all_allotment_show")
     * @param Allotment $allotment
     * @return Response
     */
    public function allotment(Allotment $allotment): Response
    {
        return $this->render('home/allotments.html.twig', [
            'allotment' => $allotment,
        ]);
    }

    /**
     * @Route ("/house/{id}", name="all_house_show")
     * @param House $house
     * @return Response
     */
    public function house(House $house): Response
    {
        return $this->render('home/house.html.twig', [
            'house' => $house,
        ]);
    }
}
