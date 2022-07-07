<?php

namespace App\Controller;

use App\Repository\GalleryRepository;
use App\Repository\InfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GalleryController extends AbstractController
{
    #[Route('/galerie', name: 'app_gallery')]
    public function index(GalleryRepository $galleryRepository, InfoRepository $infoRepository): Response
    {
        return $this->render('gallery.html.twig', [
            'galleries' => $galleryRepository->findAll(),
            'infos' => $infoRepository->findAll(),
        ]);
    }
}
