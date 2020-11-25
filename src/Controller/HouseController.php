<?php

namespace App\Controller;

use App\Entity\House;
use App\Form\HouseType;
use App\Form\House\HouseSearchType;
use App\Repository\HouseRepository;
use App\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/house")
 */
class HouseController extends AbstractController
{
    /**
     * @Route("/", name="house_index", methods={"GET", "POST"})
     */
    public function index(Request $request, HouseRepository $houseRepository): Response
    {
        $searchForm = $this->createForm(HouseSearchType::class);
        $searchForm->handleRequest($request);


        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $dataAll = $searchForm->getData();

            $model = $houseRepository->searchByName($dataAll);
        } else {
            $model = $houseRepository->findAll();
        }

        return $this->render('house/index.html.twig', [
            'houses' => $model,
            'form' => $searchForm->createView(),
        ]);
    }


    /**
     * @Route("/new", name="house_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $house = new House();
        $form = $this->createForm(HouseType::class, $house);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $planFile = $form->get('plan')->getData();
            if($planFile){
                $planFileName = $fileUploader->upload($planFile);
                $house->setPlanFilename($planFileName);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($house);
            $entityManager->flush();

            return $this->redirectToRoute('house_index');
        }

        return $this->render('house/new.html.twig', [
            'house' => $house,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="house_show", methods={"GET"})
     */
    public function show(House $house): Response
    {
        return $this->render('house/show.html.twig', [
            'house' => $house,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="house_edit", methods={"GET","POST"})
     * @param Request $request
     * @param House $house
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function edit(Request $request, House $house, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(HouseType::class, $house);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $planFile = $form->get('plan')->getData();
            $currentPlanFile = $house->getPlanFilename();


            if(is_null($planFile) && $currentPlanFile){
                $fileUploader->delete($house->getPlanFilename());
                $house->setPlanFilename("");
            }

            elseif ($planFile !== $currentPlanFile && $planFile){
                $planFileName = $fileUploader->upload($planFile);
                if($currentPlanFile){
                    $fileUploader->delete($house->getPlanFilename());
                }
                $house->setPlanFilename($planFileName);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('house_index');
        }

        return $this->render('house/edit.html.twig', [
            'house' => $house,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="house_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     * @param Request $request
     * @param House $house
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function delete(Request $request, House $house, FileUploader $fileUploader): Response
    {
        if ($this->isCsrfTokenValid('delete' . $house->getId(), $request->request->get('_token'))) {
            $file = $house->getPlanFilename();

            if($file)
            {
                $fileUploader->delete($file);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($house);
            $entityManager->flush();
        }


        return $this->redirectToRoute('house_index');
    }
}
