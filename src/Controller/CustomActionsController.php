<?php

namespace App\Controller;

use App\Repository\HouseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomActionsController extends AbstractController
{
    /**
     * @Route("/custom/actions", name="custom_actions")
     */
    public function index(): Response
    {
        return $this->render('custom_actions/index.html.twig', [
            'controller_name' => 'CustomActionsController',
        ]);
    }

    /**
     * @Route("/custom/actions/housetaxes", name="custom_actions_housetaxes")
     */
    public function addHouseTaxes(HouseRepository $houseRepository): Response
    {
         $houseData = $houseRepository->findAll();

         foreach($houseData as $house)
         {
             $priceDf = $house->getSellingPriceDf();
             $house->setSellingPriceAti(($priceDf*1.20));
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($house);
             $entityManager->flush();             
         }

         return $this->render('admin_home/index.html.twig', [
            'controller_name' => 'AdminHomeController',
        ]);
    }
}
