<?php

namespace App\Controller\Land;

use App\Entity\Land\Allotment;
use App\Form\Land\AllotmentType;
use App\Repository\Land\AllotmentRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route("/cc/land/allotment")]
class AllotmentController extends AbstractController
{
    #[Route("/", name: "land_allotment_index", methods: ["GET"])]
    /**
     * @param AllotmentRepository $allotmentRepository
     * @return Response
     */
    public function index(AllotmentRepository $allotmentRepository): Response
    {
        return $this->render('land/allotment/index.html.twig', [
            'allotments' => $allotmentRepository->findAll(),

        ]);
    }

    /**
     * @Route("/new", name="land_allotment_new", methods={"GET","POST"})
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $allotment = new Allotment();
        $form = $this->createForm(AllotmentType::class, $allotment);
        $form->handleRequest($request);

        //Recupere les fichiers du formulaire
        $localPlanFile = $form->get('localUrbanPlanFile')->getData();
        $regulationFile = $form->get('regulationFile')->getData();
        $allotmentPlanFile = $form->get('allotmentPlanFile')->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            //gestion des fichiers upload
            if($localPlanFile){
                $allotment->setLocalUrbanPlanFile( $fileUploader->upload($localPlanFile));
            }
            if($regulationFile){
                $allotment->setRegulationFile($fileUploader->upload($regulationFile));
            }
            if($allotmentPlanFile){
                $allotment->setAllotmentPlanFile($fileUploader->uploadPicture($allotmentPlanFile));
            }


            //Recupere les plans de vente du Formulaire embarque Plot
            foreach ($form->get('plots') as $a)
            {
                //dump($a->get('salesPlan')->getData());
                $salesPlanFile = $a->get('salesPlan')->getData();
                //dump($a->getData());
                $plot = $a->getData();
                if($salesPlanFile){
                    //$fileUploader->upload($salesPlanFile);
                    $plot->setSalesPlan($fileUploader->upload($salesPlanFile));

                }
            }



            $entityManager->persist($allotment);
            $entityManager->flush();

            return $this->redirectToRoute('land_allotment_index');
        }

        return $this->render('land/allotment/new.html.twig', [
            'allotment' => $allotment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="land_allotment_show", methods={"GET"})
     */
    public function show(Allotment $allotment): Response
    {
        return $this->render('land/allotment/show.html.twig', [
            'allotment' => $allotment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="land_allotment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Allotment $allotment, FileUploader $fileUploader): Response
    {


        $form = $this->createForm(AllotmentType::class, $allotment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //Recupere les fichiers du formulaire
            $localPlanFile = $form->get('localUrbanPlanFile')->getData();
            $regulationFile = $form->get('regulationFile')->getData();
            $allotmentPlanFile = $form['allotmentPlanFile']->getData();

            //Recupere les plans de vente du Formulaire embarque Plot
            foreach ($form->get('plots') as $a)
            {
                //dump($a->get('salesPlan')->getData());
                $salesPlanFile = $a->get('salesPlan')->getData();
                //dump($a->getData());
                $plot = $a->getData();
                if($salesPlanFile){
                    //$fileUploader->upload($salesPlanFile);
                    $plot->setSalesPlan($fileUploader->upload($salesPlanFile));

                }
            }




            //Traitement des fichiers
            if($localPlanFile){
                $fileUploader->delete($allotment->getLocalUrbanPlanFile());
                $allotment->setLocalUrbanPlanFile($fileUploader->upload($localPlanFile));
            }
           if($regulationFile){
               $fileUploader->delete($allotment->getRegulationFile());
               $allotment->setRegulationFile( $fileUploader->upload($regulationFile));
           }
           if($allotmentPlanFile){
               $fileUploader->deletePicture($allotment->getAllotmentPlanFile());
               $allotment->setAllotmentPlanFile($fileUploader->uploadPicture($allotmentPlanFile));
           }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('land_allotment_index');
        }

        return $this->render('land/allotment/edit.html.twig', [
            'allotment' => $allotment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="land_allotment_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Allotment $allotment, FileUploader $fileUploader): Response
    {
        if ($this->isCsrfTokenValid('delete' . $allotment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $fileUploader->delete($allotment->getLocalUrbanPlanFile());
            $fileUploader->delete($allotment->getRegulationFile());
            $fileUploader->deletePicture(($allotment->getAllotmentPlanFile()));

            foreach ($allotment->getPlots() as $plot){
                $fileUploader->delete($plot->getSalesPlan());
            }

            $entityManager->remove($allotment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('land_allotment_index');
    }
}
