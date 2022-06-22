<?php

namespace App\Controller;

use App\Repository\SectionCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminSectionCategoriesController extends AbstractController
{
    #[Route('/admin/section-categories', name: 'app_section_categories')]
    public function index(SectionCategoryRepository $sectionCategoryRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/section_categories/index.html.twig', [
            'section_categories' => $sectionCategoryRepository->findAll(),
        ]);
    }
}
