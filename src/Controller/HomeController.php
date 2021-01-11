<?php

namespace App\Controller;

use App\Entity\House;
use App\Entity\Land\Allotment;
use App\Entity\Land\Plot;
use App\Entity\Matching\PlotHouseMatching;
use App\Form\TerrainsMaisons\AllotmentSearchType;
use App\Form\TerrainsMaisons\HouseSearchType;
use App\Repository\HouseRepository;
use App\Repository\Land\AllotmentRepository;
use App\Repository\Land\PlotRepository;
use App\Repository\Matching\PlotHouseMatchingRepository;
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
     * @param PlotHouseMatchingRepository $plotHouseMatchingRepository
     * @return Response
     */
    #[Route('/allotment/plot/{id}', name:'all_plot_show', requirements: ['id'=>'\d+'])]
    public function plot(Request $request,Plot $plot, HouseRepository $houseRepository, PlotHouseMatchingRepository $plotHouseMatchingRepository): Response
    {

        $searchForm = $this->createForm(HouseSearchType::class);
        $searchForm->handleRequest($request);

        //Formulaire de recherche soumis
        if($searchForm->isSubmitted() && $searchForm->isValid()) {
            $numberRoomData = $searchForm->get('roomNumber')->getData();

            $houses = $plotHouseMatchingRepository->findByHouseBedroom($plot, $numberRoomData);
            return $this->render('home/plot_houses.html.twig', [
                '_fragment' => 'house-list',
                'houses' => $houses,
                'plot' => $plot,
                'form' => $searchForm->createView(),

            ]);
        }

        $houses = $plotHouseMatchingRepository->findBy(['plot'=>$request->get('id')], ['sellingPriceAti'=>'ASC']);
        return $this->render('home/plot_houses.html.twig', [
            'houses' => $houses,
            'plot' => $plot,
            'form' => $searchForm->createView(),

        ]);
    }


    /**
     * @param Allotment $allotment
     * @param PlotRepository $plotRepository
     * @return Response
     */
    #[Route('/allotment/{id}', name: 'all_allotment_show', requirements: ['id'=>'\d+'])]
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
     * @param PlotHouseMatchingRepository $plotHouseMatchingRepository
     * @param AllotmentRepository $allotmentRepository
     * @return Response
     */
    #[Route('/houses/{id}', name: 'all_house_show', requirements: ['id'=>'\d+'])]
    public function house(House $house, PlotHouseMatchingRepository $plotHouseMatchingRepository, AllotmentRepository $allotmentRepository): Response
    {
        $allotments = $allotmentRepository->findByHouse($house);
        $matchs = $plotHouseMatchingRepository->findBy(['house'=>$house]);
        //$allotmentsMatch = $allotmentRepository->findBy(['id' => $matchs->getPlot])
        return $this->render('home/house.html.twig', [
            'matchs' => $matchs,
            'house' => $house,
            'allotments' => $allotments,
        ]);
    }

    /**
     * @param HouseRepository $houseRepository
     * @param Request $request
     * @return Response
     */
    #[Route('/houses', name: 'all_houses_list')]
    public function houses(HouseRepository $houseRepository, Request $request): Response
    {
        $searchForm = $this->createForm(HouseSearchType::class);
        $searchForm->handleRequest($request);

        if($searchForm->isSubmitted() && $searchForm->isValid()){
            $houseBedroom = $searchForm->get('roomNumber')->getData();
            $houseModel = $searchForm->get('houseModel')->getData();

            $houses = $houseRepository->findBy([
                'roomNumber' => $houseBedroom,
                'houseModel' => $houseModel,
            ], ['sellingPriceAti' => 'ASC']);
        }
        else{
            $houses = $houseRepository->findBy([], ['sellingPriceAti'=>'ASC']);
        }

        return $this->render('home/houses.html.twig', [
            'houses' => $houses,
            'form' => $searchForm->createView(),
        ]);
    }

    #[Route('/projet/{id}', name:'all_ad_show', requirements: ['id'=>'\d+'])]
    public function adPlotHouse(PlotHouseMatching $houseMatching): Response
    {
        return $this->render('home/ad_plot_house.html.twig', [
            'ad' => $houseMatching
        ]);
    }
}
