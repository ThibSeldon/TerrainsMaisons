<?php

namespace App\Controller;

use App\Repository\HouseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(HouseRepository $houseRepository): Response
    {
        $houses = $houseRepository->loadHouseBerdin();

        return $this->render('home/index.html.twig', [
            'houses' => $houses,
        ]);
    }
}
