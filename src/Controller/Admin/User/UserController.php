<?php

namespace App\Controller\Admin\User;

use App\Entity\Admin\User\User;
use App\Form\Admin\User\UserType;
use App\Repository\Admin\User\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin/user/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="admin_user_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin/user/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_user_user_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $passEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
       

        if ($form->isSubmitted() && $form->isValid()) {
            //Encode le Password
            $pw = $form->getData()->getPassword();
            $user->setPassword($passEncoder->encodePassword($user, $pw));
            
            $entityManager = $this->getDoctrine()->getManager();           
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin_user_user_index');
        }

        return $this->render('admin/user/user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_user_user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('admin/user/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_user_user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $passEncoder): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Encode le password
            $pw = $form->getData()->getPassword();
            $user->setPassword($passEncoder->encodePassword($user, $pw));            

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_user_user_index');
        }

        return $this->render('admin/user/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_user_user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_user_user_index');
    }
}
