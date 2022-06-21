<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SectionsTypesController extends AbstractController
{
    #[Route('/admin/sections-types', name: 'app_sections_types')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/sections_types/index.html.twig', [
            'controller_name' => 'SectionsTypesController',
        ]);
    }
}
