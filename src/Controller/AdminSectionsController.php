<?php

namespace App\Controller;

use App\Repository\SectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminSectionsController extends AbstractController
{
    #[Route('/admin/sections', name: 'app_sections')]
    public function index(SectionRepository $sectionRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/sections/index.html.twig', [
            'sections' => $sectionRepository->findAll(),
        ]);
    }
}
