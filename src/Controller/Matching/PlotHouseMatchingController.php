<?php

namespace App\Controller\Matching;

use App\Entity\Matching\PlotHouseMatching;
use App\Form\Matching\PlotHouseMatchingType;
use App\Repository\HouseRepository;
use App\Repository\Land\AllotmentRepository;
use App\Repository\Land\PlotRepository;
use App\Repository\Matching\PlotHouseMatchingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cc/matching/plot/house')]
class PlotHouseMatchingController extends AbstractController
{
    #[Route('/', name: 'matching_plot_house_matching_index', methods: ['GET'])]
    public function index(PlotHouseMatchingRepository $plotHouseMatchingRepository): Response
    {
        return $this->render('matching/plot_house_matching/index.html.twig', [
            'plot_house_matchings' => $plotHouseMatchingRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'matching_plot_house_matching_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $plotHouseMatching = new PlotHouseMatching();
        $form = $this->createForm(PlotHouseMatchingType::class, $plotHouseMatching);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($plotHouseMatching);
            $entityManager->flush();

            return $this->redirectToRoute('matching_plot_house_matching_index');
        }

        return $this->render('matching/plot_house_matching/new.html.twig', [
            'plot_house_matching' => $plotHouseMatching,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'matching_plot_house_matching_show', methods: ['GET'])]
    public function show(PlotHouseMatching $plotHouseMatching): Response
    {
        return $this->render('matching/plot_house_matching/show.html.twig', [
            'plot_house_matching' => $plotHouseMatching,
        ]);
    }

    #[Route('/{id}/edit', name: 'matching_plot_house_matching_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PlotHouseMatching $plotHouseMatching): Response
    {
        $form = $this->createForm(PlotHouseMatchingType::class, $plotHouseMatching);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('matching_plot_house_matching_index');
        }

        return $this->render('matching/plot_house_matching/edit.html.twig', [
            'plot_house_matching' => $plotHouseMatching,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'matching_plot_house_matching_delete', methods: ['DELETE'])]
    public function delete(Request $request, PlotHouseMatching $plotHouseMatching): Response
    {
        if ($this->isCsrfTokenValid('delete' . $plotHouseMatching->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($plotHouseMatching);
            $entityManager->flush();
        }

        return $this->redirectToRoute('matching_plot_house_matching_index');
    }

    #[Route('/makematch', name: 'matching_plot_house_makematch', priority: 1)]
    public function makematch(PlotHouseMatchingRepository $plotHouseMatchingRepository, AllotmentRepository $allotmentRepository, PlotRepository $plotRepository, HouseRepository $houseRepository)
    {
        $houses = $houseRepository->findBy(['valid' => true]);
        $em = $this->getDoctrine()->getManager();
        foreach ($houses as $house) {
            $allotments = $allotmentRepository->findAllotmentByRoofing($house->getHouseRoofing()->getName());
            //dump($allotments);

            foreach ($allotments as $allotment) {


                $plots = $plotRepository->getPlotsForHouse($house, $allotment);
                foreach ($plots as $plot) {
                    $findMatch = $plotHouseMatchingRepository->findOneBy(['plot' => $plot, 'house' => $house]);
                    if ($findMatch) {
                        $findMatch->setHouse($house);
                        $findMatch->setPlot($plot);
                        $findMatch->setName(
                            'Maison '
                            . $house->getName()
                            . ' '
                            . $house->getRoomNumber()
                            . ' Chambres '
                            . $house->getLivingSpace()
                            . ' m2 à '
                            . $allotment->getCity()
                        );
                        $findMatch->setValid(true);
                        $findMatch->setSellingPriceAti(
                            $house->getSellingPriceAti() + $plot->getSellingPriceAti()
                        );
                        $em->persist($findMatch);
                    } else {
                        $plotHouseMatching = new PlotHouseMatching();
                        $plotHouseMatching->setHouse($house);
                        $plotHouseMatching->setPlot($plot);
                        $plotHouseMatching->setName(
                            'Maison '
                            . $house->getName()
                            . ' '
                            . $house->getRoomNumber()
                            . ' Chambres '
                            . $house->getLivingSpace()
                            . ' m2 à '
                            . $allotment->getCity()
                        );
                        $plotHouseMatching->setValid(true);
                        $plotHouseMatching->setSellingPriceAti(
                            $house->getSellingPriceAti() + $plot->getSellingPriceAti()
                        );

                        $em->persist($plotHouseMatching);
                    }


                }

            }

        }
        $em->flush();

        return $this->render('matching/plot_house_matching/index.html.twig', [
            'plot_house_matchings' => $plotHouseMatchingRepository->findBy([], ['house' => 'ASC'])
        ]);


    }
}
