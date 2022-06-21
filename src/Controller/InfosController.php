<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfosController extends AbstractController
{
    #[Route('/admin/infos', name: 'app_infos')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/infos/index.html.twig', [
            'controller_name' => 'InfosController',
        ]);
    }
}
