<?php

namespace App\Controller\Admin\House;

use App\Entity\Admin\House\HouseBrand;
use App\Form\Admin\House\HouseBrandType;
use App\Repository\Admin\House\HouseBrandRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cc/admin/house/house/brand")
 */
class HouseBrandController extends AbstractController
{
    /**
     * @Route("/", name="admin_house_house_brand_index", methods={"GET"})
     */
    public function index(HouseBrandRepository $houseBrandRepository): Response
    {
        return $this->render('admin/house/house_brand/index.html.twig', [
            'house_brands' => $houseBrandRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_house_house_brand_new", methods={"GET","POST"})
     */
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $houseBrand = new HouseBrand();
        $form = $this->createForm(HouseBrandType::class, $houseBrand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($form['logo']->getData()){
                $houseBrand->setLogo($fileUploader->uploadPicture($form->get('logo')->getData()));
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($houseBrand);
            $entityManager->flush();

            return $this->redirectToRoute('admin_house_house_brand_index');
        }

        return $this->render('admin/house/house_brand/new.html.twig', [
            'house_brand' => $houseBrand,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_house_house_brand_show", methods={"GET"})
     */
    public function show(HouseBrand $houseBrand): Response
    {
        return $this->render('admin/house/house_brand/show.html.twig', [
            'house_brand' => $houseBrand,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_house_house_brand_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, HouseBrand $houseBrand, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(HouseBrandType::class, $houseBrand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logoPicture = $form->get('logo')->getData();
            if($logoPicture){
                $fileUploader->deletePicture($houseBrand->getLogo());
                $houseBrand->setLogo($fileUploader->uploadPicture($logoPicture));
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_house_house_brand_index');
        }

        return $this->render('admin/house/house_brand/edit.html.twig', [
            'house_brand' => $houseBrand,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_house_house_brand_delete", methods={"DELETE"})
     */
    public function delete(Request $request, HouseBrand $houseBrand, FileUploader $fileUploader): Response
    {
        if ($this->isCsrfTokenValid('delete'.$houseBrand->getId(), $request->request->get('_token'))) {
            $fileUploader->deletePicture($houseBrand->getLogo());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($houseBrand);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_house_house_brand_index');
    }
}
