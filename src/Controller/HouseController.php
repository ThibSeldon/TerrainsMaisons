<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Flex\Unpack\Result;

class HouseController extends AbstractController
{
    /**
     * @Route("/house", name="house")
     */
    public function index(): Response
    {       
           return $this->render('house/index.html.twig',[
               'controller_name' => 'House::Index'
           ]);
       
    }
}
