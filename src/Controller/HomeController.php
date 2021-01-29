<?php

namespace App\Controller;

use App\Entity\House;
use App\Entity\Land\Allotment;
use App\Entity\Land\Plot;
use App\Entity\Matching\PlotHouseMatching;
use App\Form\Matching\PHMSearchType;
use App\Form\TerrainsMaisons\AllotmentSearchType;
use App\Form\TerrainsMaisons\HouseSearchType;
use App\Repository\Admin\House\HouseBrandRepository;
use App\Repository\Admin\House\HouseModelRepository;
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
     * @param PlotHouseMatchingRepository $plotHouseMatchingRepository
     * @return Response
     */
    #[Route('/', name: 'home')]
    public function index(Request $request, AllotmentRepository $allotmentRepository, PlotHouseMatchingRepository $plotHouseMatchingRepository): Response
    {

        $searchForm = $this->createForm(AllotmentSearchType::class);
        $searchForm->handleRequest($request);
        $countMatchs = $plotHouseMatchingRepository->count([]);

        if($searchForm->isSubmitted() && $searchForm->isValid()){
            //Pourquoi je recupere l objet allotment et non le champ city ? (ca fonctionne commme ca)
            $data = $searchForm->get('city')->getData();
            $allotments = $allotmentRepository->findBySearchForm($data);
            return $this->render('home/index.html.twig', [
                '_fragment' => 'allotment-list',
                'allotments' => $allotments,
                'form' => $searchForm->createView(),
                'countMatchs' => $countMatchs,

            ]);
    }

        $allotments = $allotmentRepository->findBy(['isValid' => true], ['city' => 'ASC']);
        return $this->render('home/index.html.twig', [
            'allotments' => $allotments,
            'form' => $searchForm->createView(),
            'countMatchs' => $countMatchs,
        ]);


    }

    /**
     * @param Request $request
     * @param HouseRepository $houseRepository
     * @param PlotHouseMatchingRepository $plotHouseMatchingRepository
     * @param PlotRepository $plotRepository
     * @return Response
     */
    #[Route('/lotissement/terrain/{id}', name:'all_plot_show', requirements: ['id'=>'\d+'])]
    public function plot(Request $request, HouseRepository $houseRepository, PlotHouseMatchingRepository $plotHouseMatchingRepository, PlotRepository $plotRepository): Response
    {
        $plotId = $request->get('id');
        $plot = $plotRepository->findOneBy(['id'=>$plotId]);

        if($plot)
            {
                $searchForm = $this->createForm(HouseSearchType::class);
                $searchForm->handleRequest($request);

                //Formulaire de recherche soumis
                if ($searchForm->isSubmitted() && $searchForm->isValid()) {
                    $numberRoomData = $searchForm->get('roomNumber')->getData();
                    $houseBrand = $searchForm->get('houseBrand')->getData();
                    $budgetMax = $searchForm->get('matchSellingPriceAti')->getData();


                    $houses = $plotHouseMatchingRepository->findByHouseBedroom($plot, $numberRoomData, $houseBrand, $budgetMax);
                    return $this->render('home/plot_houses.html.twig', [
                        'houses' => $houses,
                        'plot' => $plot,
                        'form' => $searchForm->createView(),
                        '_fragment' => '#house-list',

                    ]);
                }

                $houses = $plotHouseMatchingRepository->findBy(['plot' => $request->get('id')], ['sellingPriceAti' => 'ASC']);
                return $this->render('home/plot_houses.html.twig', [
                    'houses' => $houses,
                    'plot' => $plot,
                    'form' => $searchForm->createView(),

                ]);
            }
        return $this->redirectToRoute('home');
    }


    /**
     * @param Request $request
     * @param PlotRepository $plotRepository
     * @param AllotmentRepository $allotmentRepository
     * @return Response
     */
    #[Route('/lotissement/{id}', name: 'all_allotment_show', requirements: ['id'=>'\d+'])]
    public function allotment(Request $request, PlotRepository $plotRepository, AllotmentRepository $allotmentRepository): Response
    {
        $id = $request->get('id');
        $allotment = $allotmentRepository->findOneBy(['id'=>$id]);
     if($allotment){
        $plots = $plotRepository->findBy(['allotment' => $allotment->getId()], ['sellingPriceAti' => 'ASC']);
        return $this->render('home/allotments.html.twig', [
            'allotment' => $allotment,
            'plots' => $plots,
        ]);

     }
     return $this->redirectToRoute('home');
    }

    /**
     * OLD-----------------
     * @param House $house
     * @param PlotHouseMatchingRepository $plotHouseMatchingRepository
     * @param AllotmentRepository $allotmentRepository
     * @return Response
     */
    #[Route('/maisons/{id}', name: 'all_house_show', requirements: ['id'=>'\d+'])]
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
     * @param House $house
     * @param PlotHouseMatchingRepository $plotHouseMatchingRepository
     * @param AllotmentRepository $allotmentRepository
     * @return Response
     */
    #[Route('/maisons/{slug}', name: 'all_house_show_by_slug', priority: 2)]
    public function houseBySlug(House $house, PlotHouseMatchingRepository $plotHouseMatchingRepository, AllotmentRepository $allotmentRepository): Response
    {
        $allotments = $allotmentRepository->findByHouse($house);
        $matchs = $plotHouseMatchingRepository->findBy(['house'=>$house], ['name'=>'ASC']);
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
     * @param HouseBrandRepository $brandRepository
     * @param HouseModelRepository $modelRepository
     * @return Response
     */
    #[Route('/maisons', name: 'all_houses_list')]
    public function houses(HouseRepository $houseRepository, Request $request,
                           HouseBrandRepository $brandRepository, HouseModelRepository $modelRepository): Response
    {
        $searchForm = $this->createForm(HouseSearchType::class);
        $searchForm->handleRequest($request);

        if($searchForm->isSubmitted() && $searchForm->isValid()){
            $maxPrice = $searchForm->get('matchSellingPriceAti')->getData() ?: 10000000;
            $houseBedroom = $searchForm->get('roomNumber')->getData();
            $houseModel = $searchForm->get('houseModel')->getData() ?: $modelRepository->findAll();
            $houseBrand = $searchForm->get('houseBrand')->getData() ?: $brandRepository->findAll();



            $houses = $houseRepository->findByMaxPrice($maxPrice, $houseBedroom, $houseModel, $houseBrand );
        }
        else{
            $houses = $houseRepository->findBy(['valid'=>true, 'roomNumber' => 4], ['sellingPriceAti'=>'ASC']);
        }

        return $this->render('home/houses.html.twig', [
            'houses' => $houses,
            'form' => $searchForm->createView(),
            '_fragment' => '#house-list,'
        ]);
    }

    #[Route('/projet/{id}', name:'all_ad_show', requirements: ['id'=>'\d+'])]
    public function adPlotHouse(Request $request, PlotHouseMatchingRepository $plotHouseMatchingRepository): Response
    {
        $id = $request->get('id');
        $match = $plotHouseMatchingRepository->findOneBy(['id'=>$id]);
        if($match){
        return $this->render('home/ad_plot_house.html.twig', [
            'ad' => $match
        ]);
        }
       return  $this->redirectToRoute('home');
    }
/*
    #[Route('/projets', name:'home_ads')]
    public function findAllAds(Request $request, PlotHouseMatchingRepository $plotHouseMatchingRepository,
                               AllotmentRepository $allotmentRepository): Response
    {
        $searchForm = $this->createForm(PHMSearchType::class);
        $searchForm->handleRequest($request);

        if($searchForm->isSubmitted() && $searchForm->isValid()){
            $budget = $searchForm->get('sellingPriceAti')->getData();
            $matchs = $plotHouseMatchingRepository->findByBudget($budget);
            $allotments = $allotmentRepository->findByMatch($matchs);

        }
        else{
        $matchs = $plotHouseMatchingRepository->findBy([], ['updatedAt'=>'ASC'], 30);
        $allotments = $allotmentRepository->findByMatch($matchs);
        }

        return $this->render('home/ads_search.html.twig', [
            'ads' => $matchs,
            'allotments' => $allotments,
            'form' => $searchForm->createView(),
        ]);
    }*/

    //Je n utilise pas le @PARAMCONVETER pour rediriger les 404 sur la home si l annonce n existe plus
    #[Route('/projet/{slug}', name:'all_ad_show_by_slug')]
    public function viewAdPlotHouse(Request $request, PlotHouseMatchingRepository $plotHouseMatchingRepository): Response
    {
        $slug = $request->get('slug');
        $match = $plotHouseMatchingRepository->findOneBy(['slug'=>$slug]);
        if(!$match) {
        return $this->redirectToRoute('home');
        }
        return $this->render('home/ad_plot_house.html.twig', [
            'ad' => $match
        ]);
    }

    #[Route('/mentions-legales', name:'legal_notice')]
    public function legaleNotice()
    {
        return $this->render('home/legale_notice.html.twig');
    }

    #[Route('/guide-utilisateur', name:'home_user_manual')]
    public function userManual()
    {
        return $this->render('home/user_manual.html.twig');
    }

    #[Route('/terrain-vendre', name:'home_selling_plot')]
    public function homeSellingPlot()
    {
        return $this->render('home/selling_plot.html.twig');
    }

}
