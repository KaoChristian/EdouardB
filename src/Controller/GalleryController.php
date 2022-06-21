<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_ADMIN')]
class GalleryController extends AbstractController
{
    #[Route('/admin/gallery', name: 'app_gallery')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/gallery/index.html.twig', [
            'controller_name' => 'GalleryController',
        ]);
    }
}
