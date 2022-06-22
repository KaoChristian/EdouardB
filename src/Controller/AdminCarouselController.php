<?php

namespace App\Controller;

use App\Repository\CarouselRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCarouselController extends AbstractController
{
    #[Route('/admin/carousel', name: 'app_carousel')]
    public function index(CarouselRepository $carouselRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/carousel/index.html.twig', [
            'carousels' => $carouselRepository->findAll(),
        ]);
    }
}
