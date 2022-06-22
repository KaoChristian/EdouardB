<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminSectionCategoriesController extends AbstractController
{
    #[Route('/admin/section-categories', name: 'app_section_categories')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/section_categories/index.html.twig', [
            'controller_name' => 'AdminSectionCategoriesController',
        ]);
    }
}
