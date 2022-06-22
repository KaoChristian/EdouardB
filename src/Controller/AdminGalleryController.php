<?php

namespace App\Controller;

use App\Repository\GalleryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminGalleryController extends AbstractController
{
    #[Route('/admin/gallery', name: 'app_gallery')]
    public function index(GalleryRepository $galleryRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/gallery/index.html.twig', [
            'galleries' => $galleryRepository->findAll(),
        ]);
    }
}
