<?php

namespace App\Controller;

use App\Entity\Publications;
use App\Form\PublicationsType;
use App\Repository\PublicationsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/publications')]
class PublicationsController extends AbstractController
{
    #[Route('/', name: 'app_publications_acceuil', methods: ['GET'])]
    public function acceuil(Request $request, PaginatorInterface $paginator, PublicationsRepository $publicationsRepository): Response
    {
        $publications = $paginator->paginate(
            $publicationsRepository->publie(),
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('publications/acceuil.html.twig', [
            'publications' => $publications,
        ]);
    }

    #[Route('/index', name: 'app_publications_index', methods: ['GET'])]
    public function index(PublicationsRepository $publicationsRepository): Response
    {
        return $this->render('publications/index.html.twig', [
            'publications' => $publicationsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_publications_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PublicationsRepository $publicationsRepository): Response
    {
        $user = $this->getUser();
        dd($user);

        $publication = new Publications();
        $form = $this->createForm(PublicationsType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $publicationsRepository->add($publication);
            return $this->redirectToRoute('app_publications_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('publications/new.html.twig', [
            'publication' => $publication,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_publications_show', methods: ['GET'])]
    public function show(?Publications $publication): Response
    {
        if (!$publication) {
            return $this->redirectToRoute('app_blog');
        }

        $user = $this->getUser();

        return $this->render('publications/show.html.twig', [
            'publication' => $publication,
        ]);
    }

    #[Route('/{slug}/edit', name: 'app_publications_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ?Publications $publication, PublicationsRepository $publicationsRepository): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(PublicationsType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $publicationsRepository->add($publication);
            return $this->redirectToRoute('app_publications_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('publications/edit.html.twig', [
            'publication' => $publication,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_publications_delete', methods: ['POST'])]
    public function delete(Request $request, Publications $publication, PublicationsRepository $publicationsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $publication->getId(), $request->request->get('_token'))) {
            $publicationsRepository->remove($publication);
        }

        return $this->redirectToRoute('app_publications_index', [], Response::HTTP_SEE_OTHER);
    }
}
