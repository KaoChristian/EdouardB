<?php

namespace App\Controller;

use App\Repository\InfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PricingController extends AbstractController
{
    #[Route('/pricing', name: 'app_pricing')]
    public function index(InfoRepository $infoRepository): Response
    {
        return $this->render('pricing.html.twig', [
            'controller_name' => 'PricingController',
            'infos' => $infoRepository->findAll(),
        ]);
    }
}
