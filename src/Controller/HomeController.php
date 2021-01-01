<?php

namespace App\Controller;

use App\Entity\House;
use App\Entity\Land\Allotment;
use App\Entity\Land\Plot;
use App\Form\TerrainsMaisons\AllotmentSearchType;
use App\Repository\HouseRepository;
use App\Repository\Land\AllotmentRepository;
use App\Repository\Land\PlotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 * @Route("/")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param Request $request
     * @param AllotmentRepository $allotmentRepository
     * @return Response
     */
    public function index(Request $request, AllotmentRepository $allotmentRepository): Response
    {
        $searchForm = $this->createForm(AllotmentSearchType::class);
        $searchForm->handleRequest($request);
        if($searchForm->isSubmitted() && $searchForm->isValid()){
            dump($searchForm);
            $data = $searchForm->get('city')->getData();

            dump($data);
            $allotments = $allotmentRepository->findBySearchForm($data);

    }
        else {
            $allotments = $allotmentRepository->findBy(['isValid' => true], ['city' => 'ASC']);
        }
        return $this->render('home/index.html.twig', [

            'allotments' => $allotments,
            'form' => $searchForm->createView(),
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
        $aDoubleLimit = $plot->getAllotment()->getDoubleLimit();
        $limit = $plot->getAllotment()->getPropertyLimit();
        $plotFW = $plot->getFacadeWidth();

        $allotmentRoofings = $plot->getAllotment()->getHouseRoofings();
        $roofings = [];
        foreach ($allotmentRoofings as $arg){
            $roofings[] = $arg;
        }


        $houses = $houseRepository->findHousesPlotCompatible($aDoubleLimit, $limit, $plotFW, $roofings);

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
    public function allotment(Allotment $allotment, PlotRepository $plotRepository): Response
    {
        $plots = $plotRepository->findBy(['allotment' => $allotment->getId()], ['sellingPriceAti' => 'ASC']);
        return $this->render('home/allotments.html.twig', [
            'allotment' => $allotment,
            'plots' => $plots,
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
