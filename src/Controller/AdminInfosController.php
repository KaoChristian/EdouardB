<?php

namespace App\Controller;

use App\Repository\InfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminInfosController extends AbstractController
{
    #[Route('/admin/infos', name: 'app_infos')]
    public function index(InfoRepository $infoRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/infos/index.html.twig', [
            'infos' => $infoRepository->findAll(),
        ]);
    }
}
