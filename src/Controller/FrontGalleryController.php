<?php

namespace App\Controller;

use App\Repository\GalleryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontGalleryController extends AbstractController
{
    #[Route('/gallery', name: 'app_front_gallery')]
    public function index(GalleryRepository $galleryRepository): Response
    {
        return $this->render('front_gallery/index.html.twig', [
            'galleries' => $galleryRepository->findAll(),
        ]);
    }
}
