<?php

namespace App\Controller;

use App\Entity\SectionCategory;
use App\Form\SectionCategoryType;
use App\Repository\SectionCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminSectionCategoriesController extends AbstractController
{
    #[Route('/admin/section-categories', name: 'admin_section_categories')]
    public function index(SectionCategoryRepository $sectionCategoryRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/section_categories/index.html.twig', [
            'section_categories' => $sectionCategoryRepository->findAll(),
        ]);
    }

    #[Route('/admin/section-categories/new', name: 'admin_section_categories_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SectionCategoryRepository $sectionCategoryRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $sectionCategory = new SectionCategory();
        $form = $this->createForm(SectionCategoryType::class, $sectionCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sectionCategoryRepository->add($sectionCategory, true);

            return $this->redirectToRoute('admin_section_categories', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/section_categories/new.html.twig', [
            'section_category' => $sectionCategory,
            'form' => $form,
        ]);
    }

    #[Route('/admin/section-categories/{id}/edit', name: 'admin_section_categories_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SectionCategory $sectionCategory, SectionCategoryRepository $sectionCategoryRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $form = $this->createForm(SectionCategoryType::class, $sectionCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sectionCategoryRepository->add($sectionCategory, true);

            return $this->redirectToRoute('admin_section_categories', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/section_categories/edit.html.twig', [
            'section_category' => $sectionCategory,
            'form' => $form,
        ]);
    }

    #[Route('/admin/section-categories/{id}', name: 'admin_section_categories_delete', methods: ['POST'])]
    public function delete(Request $request, SectionCategory $sectionCategory, SectionCategoryRepository $sectionCategoryRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        if ($this->isCsrfTokenValid('delete'.$sectionCategory->getId(), $request->request->get('_token'))) {
            $sectionCategoryRepository->remove($sectionCategory, true);
        }

        return $this->redirectToRoute('admin_section_categories', [], Response::HTTP_SEE_OTHER);
    }
}
