<?php

namespace App\Controller;

use App\Entity\House;
use App\Entity\Land\Allotment;
use App\Entity\Land\Plot;
use App\Form\TerrainsMaisons\AllotmentSearchType;
use App\Form\TerrainsMaisons\HouseSearchType;
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
 */
#[Route('/')]
class HomeController extends AbstractController
{
    /**
     * @param Request $request
     * @param AllotmentRepository $allotmentRepository
     * @return Response
     */
    #[Route('/', name: 'home')]
    public function index(Request $request, AllotmentRepository $allotmentRepository): Response
    {

        $searchForm = $this->createForm(AllotmentSearchType::class);
        $searchForm->handleRequest($request);

        if($searchForm->isSubmitted() && $searchForm->isValid()){
            //Pourquoi je recupere l objet allotment et non le champ city ? (ca fonctionne commme ca)
            $data = $searchForm->get('city')->getData();
            $allotments = $allotmentRepository->findBySearchForm($data);
            return $this->render('home/index.html.twig', [
                '_fragment' => 'allotment-list',
                'allotments' => $allotments,
                'form' => $searchForm->createView(),
            ]);
    }

        $allotments = $allotmentRepository->findBy(['isValid' => true], ['city' => 'ASC']);
        return $this->render('home/index.html.twig', [

            'allotments' => $allotments,
            'form' => $searchForm->createView(),
        ]);


    }

    /**
     * @param Request $request
     * @param Plot $plot
     * @param HouseRepository $houseRepository
     * @return Response
     */
    #[Route('/allotment/plot/{id}', name:'all_plot_show')]
    public function lot(Request $request,Plot $plot, HouseRepository $houseRepository): Response
    {
        $searchForm = $this->createForm(HouseSearchType::class);
        $searchForm->handleRequest($request);

        //Formulaire de recherche soumis
        if($searchForm->isSubmitted() && $searchForm->isValid()) {
            $numberRoomData = $searchForm->get('roomNumber')->getData();

            $aDoubleLimit = $plot->getAllotment()->getDoubleLimit();
            $limit = $plot->getAllotment()->getPropertyLimit();
            $plotFW = $plot->getFacadeWidth();

            $allotmentRoofings = $plot->getAllotment()->getHouseRoofings();
            $roofings = [];
            foreach ($allotmentRoofings as $arg){
                $roofings[] = $arg;
            }


            $houses = $houseRepository->searchHouseRoom($aDoubleLimit, $limit, $plotFW, $roofings, $numberRoomData );
            return $this->render('home/plot_houses.html.twig', [
                'houses' => $houses,
                'plot' => $plot,
                'form' => $searchForm->createView(),

            ]);

        }

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
            'plot' => $plot,
            'form' => $searchForm->createView(),

        ]);
    }


    /**
     * @param Allotment $allotment
     * @return Response
     */
    #[Route('/allotment/{id}', name: 'all_allotment_show')]
    public function allotment(Allotment $allotment, PlotRepository $plotRepository): Response
    {
        $plots = $plotRepository->findBy(['allotment' => $allotment->getId()], ['sellingPriceAti' => 'ASC']);
        return $this->render('home/allotments.html.twig', [
            'allotment' => $allotment,
            'plots' => $plots,
        ]);
    }

    /**
     * @param House $house
     * @return Response
     */
    #[Route('/house/{id}', name: 'all_house_show')]
    public function house(House $house): Response
    {
        return $this->render('home/house.html.twig', [
            'house' => $house,
        ]);
    }
}
