<?php

namespace App\Controller;

use App\Repository\HouseRepository;
use App\Repository\Land\AllotmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    /**
     * @Route("/sitemap", name="sitemap", defaults={"_format"="xml"})
     * @param Request $request
     * @param AllotmentRepository $allotmentRepository
     * @return Response
     */
    public function index(Request $request, AllotmentRepository $allotmentRepository, HouseRepository $houseRepository): Response
    {
        $hostname = $request->getSchemeAndHttpHost();


        //On initialise un tableau pour lister les URLs
        $urls = [];

        $urls[] = ['loc' => $this->generateUrl('home')];
        $urls[] = ['loc' => $this->generateUrl('app_login')];


        //URLs des pages dynamiques
        foreach ($allotmentRepository->findBy(['isValid' => 'true']) as $allotment) {
            $updatedAt = "";
            if ($allotment->getUpdatedAt()){
                $updatedAt = $allotment->getUpdatedAt()->format('Y-m-d');
            }
            else{
                $updatedAt = $allotment->getCreatedAt()->format('Y-m-d');
            }
            $urls[] = ['loc' => $this->generateUrl('all_allotment_show', [
                'id' => $allotment->getId()
            ]),
                'lastmod' => $updatedAt,
            ];
        }

        foreach ($houseRepository->findBy(['valid' => 'true']) as $house) {
            $images = [];
            $updatedAt = "";
            if ($house->getUpdatedAt()){
                $updatedAt = $house->getUpdatedAt()->format('Y-m-d');
            }
            else{
                $updatedAt = $house->getCreatedAt()->format('Y-m-d');
            }
            foreach($house->getPictures() as $picture){
            $images[] = [
                'loc' => '/uploads/pictures/'.$picture->getName(),
                'title' => 'Terrains Maisons Construction Marne'
            ];
            }

            $urls[] = ['loc'=> $this->generateUrl('all_house_show',[
            'id'=> $house->getId()
            ]),
                'lastmod' => $updatedAt,
                'image' => $images[0],
            ];
        }

        $response = new Response(
            $this->renderView('sitemap/index.html.twig', [
                'urls' => $urls,
                'hostname' => $hostname,
            ]),
            200
        );
        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }
}
