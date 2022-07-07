<?php

namespace App\Controller;

use App\Entity\Section;
use App\Form\SectionType;
use App\Repository\SectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminSectionsController extends AbstractController
{
    #[Route('/admincarbonelampe/sections', name: 'admin_sections')]
    public function index(SectionRepository $sectionRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/sections/index.html.twig', [
            'sections' => $sectionRepository->findAll(),
        ]);
    }

    #[Route('/admincarbonelampe/sections/new', name: 'admin_sections_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SectionRepository $sectionRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $section = new Section();
        $form = $this->createForm(SectionType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sectionRepository->add($section, true);

            return $this->redirectToRoute('admin_sections', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/sections/new.html.twig', [
            'section' => $section,
            'form' => $form,
        ]);
    }

    #[Route('/admincarbonelampe/sections/{id}/edit', name: 'admin_sections_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Section $section, SectionRepository $sectionRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $form = $this->createForm(SectionType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sectionRepository->add($section, true);

            return $this->redirectToRoute('admin_sections', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/sections/edit.html.twig', [
            'section' => $section,
            'form' => $form,
        ]);
    }

    #[Route('/admincarbonelampe/sections/{id}', name: 'admin_sections_delete', methods: ['POST'])]
    public function delete(Request $request, Section $section, SectionRepository $sectionRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        if ($this->isCsrfTokenValid('delete'.$section->getId(), $request->request->get('_token'))) {
            $sectionRepository->remove($section, true);
        }

        return $this->redirectToRoute('admin_sections', [], Response::HTTP_SEE_OTHER);
    }
}
