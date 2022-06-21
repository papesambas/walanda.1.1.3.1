<?php

namespace App\Controller;

use App\Repository\PublicationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/blog')]

class BlogController extends AbstractController
{
    #[Route('/', name: 'app_blog')]
    public function index(PublicationsRepository $publicationsRepository): Response
    {
        return $this->render('blog/index.html.twig', [
            'publications' => $publicationsRepository->lastsix(),
        ]);
    }
}
