<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use App\Entity\Publications;
use App\Form\EditProfileType;
use App\Form\PublicationsType;
use App\Repository\UsersRepository;
use App\Repository\PublicationsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/users')]
class UsersController extends AbstractController
{
    #[Route('/', name: 'app_users_profile', methods: ['GET'])]
    public function profile(UsersRepository $usersRepository): Response
    {
        return $this->render('users/acceuil.html.twig');
    }

    #[Route('/edit/profile', name: 'app_users_edit_profile', methods: ['GET', 'POST'])]
    public function editprofile(Request $request, UsersRepository $usersRepos): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usersRepos->add($user);
            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirectToRoute('app_users_profile', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('users/editProfile.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route('/edit/pass', name: 'app_users_edit_pass', methods: ['GET', 'POST'])]
    public function pass(Request $request, UsersRepository $usersRepos, UserPasswordHasherInterface $passwordEncoder): Response
    {
        $user = $this->getUser();
        if ($request->isMethod('POST')) {
            $user = $this->getUser();
            // ovérifie si les 2 mots de passe sont identiques
            if ($request->get('pass') == $request->get('pass2')) {
                $user->setPassword($passwordEncoder->hashPassword($user, $request->get('pass')));
                $usersRepos->add($user);
                $this->addFlash('message', 'Mot de pas a étémis à jour');
                return $this->redirectToRoute('app_users_profile', [], Response::HTTP_SEE_OTHER);
            } else {
                $this->addFlash('error', 'les deux (2) mots de passe ne sont pas identiques');
            }
        }


        return $this->renderForm('users/editPass.html.twig');
    }

    #[Route('/index', name: 'app_users_index', methods: ['GET'])]
    public function index(UsersRepository $usersRepository): Response
    {
        return $this->render('users/index.html.twig', [
            'users' => $usersRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'app_users_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UsersRepository $usersRepository): Response
    {
        $user = new Users();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usersRepository->add($user);
            return $this->redirectToRoute('app_users_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('users/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_users_show', methods: ['GET'])]
    public function show(Users $user): Response
    {
        return $this->render('users/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_users_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Users $user, UsersRepository $usersRepository): Response
    {
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usersRepository->add($user);
            return $this->redirectToRoute('app_users_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('users/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_users_delete', methods: ['POST'])]
    public function delete(Request $request, Users $user, UsersRepository $usersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $usersRepository->remove($user);
        }

        return $this->redirectToRoute('app_users_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/publications/ajout', name: 'app_user_publications_new', methods: ['GET', 'POST'])]
    public function publicationajout(Request $request, PublicationsRepository $publicationsRepository): Response
    {
        $publication = new Publications();
        $form = $this->createForm(PublicationsType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $publication->setUser($this->getUser());
            $publication->setIsActif(false);
            $publication->setIsAfficher(false);
            $publicationsRepository->add($publication);
            return $this->redirectToRoute('app_publications_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('publications/new.html.twig', [
            'publication' => $publication,
            'form' => $form,
        ]);
    }
}
