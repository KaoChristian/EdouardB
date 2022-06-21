<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SectionsController extends AbstractController
{
    #[Route('/admin/sections', name: 'app_sections')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/sections/index.html.twig', [
            'controller_name' => 'SectionsController',
        ]);
    }
}
