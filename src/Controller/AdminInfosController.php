<?php

namespace App\Controller;

use App\Entity\Info;
use App\Form\InfoType;
use App\Repository\InfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminInfosController extends AbstractController
{
    #[Route('/admincarbonelampe/infos', name: 'admin_infos')]
    public function index(InfoRepository $infoRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/infos/index.html.twig', [
            'infos' => $infoRepository->findAll(),
        ]);
    }

    #[Route('/admincarbonelampe/infos/new', name: 'admin_infos_new', methods: ['GET', 'POST'])]
    public function new(Request $request, InfoRepository $infoRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $info = new Info();
        $form = $this->createForm(InfoType::class, $info);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoRepository->add($info, true);

            return $this->redirectToRoute('admin_infos', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/infos/new.html.twig', [
            'info' => $info,
            'form' => $form,
        ]);
    }

    #[Route('/admincarbonelampe/infos/{id}/edit', name: 'admin_infos_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Info $info, InfoRepository $infoRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $form = $this->createForm(InfoType::class, $info);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoRepository->add($info, true);

            return $this->redirectToRoute('admin_infos', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/infos/edit.html.twig', [
            'info' => $info,
            'form' => $form,
        ]);
    }
}
