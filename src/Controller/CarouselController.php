<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarouselController extends AbstractController
{
    #[Route('/admin/carousel', name: 'app_carousel')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/carousel/index.html.twig', [
            'controller_name' => 'CarouselController',
        ]);
    }
}
