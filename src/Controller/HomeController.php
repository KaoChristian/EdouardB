<?php

namespace App\Controller;

use App\Repository\CarouselRepository;
use App\Repository\SectionRepository;
use App\Repository\ArticleRepository;
use App\Repository\InfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CarouselRepository $carouselRepository, SectionRepository $sectionRepository, ArticleRepository $articleRepository, InfoRepository $infoRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'carousels' => $carouselRepository->findAll(),
            'sections' => $sectionRepository->findAll(),
            'articles' => $articleRepository->findAll(),
            'infos' => $infoRepository->findAll(),
        ]);
    }
}
