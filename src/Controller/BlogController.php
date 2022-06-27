<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\PublicationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/blog')]

class BlogController extends AbstractController
{
    #[Route('/', name: 'app_blog')]
    public function index(PublicationsRepository $publicationsRepository, CategoriesRepository $categoriesRepository): Response
    {
        return $this->render('blog/index.html.twig', [
            'publications' => $publicationsRepository->lastsix(),
            'categories' => $categoriesRepository->findAll(),
        ]);
    }
}
