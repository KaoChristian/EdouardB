<?php

namespace App\Controller;

use App\Entity\SectionCategory;
use App\Form\SectionCategoryType;
use App\Repository\SectionCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminSectionCategoryCategoriesController extends AbstractController
{
    #[Route('/admin/section_categories', name: 'app_section_categories')]
    public function index(SectionCategoryRepository $sectionCategoryRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/section_categories/index.html.twig', [
            'section_categories' => $sectionCategoryRepository->findAll(),
        ]);
    }

    #[Route('/admin/section_categories/new', name: 'app_section_categories_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SectionCategoryRepository $sectioncategoryRepository): Response
    {
        $section_category = new SectionCategory();
        $form = $this->createForm(SectionCategoryType::class, $section_category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sectioncategoryRepository->add($section_category, true);

            return $this->redirectToRoute('app_sections', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/section_categories/new.html.twig', [
            'section_category' => $section_category,
            'form' => $form,
        ]);
    }

    #[Route('/admin/section_categories/{id}/edit', name: 'app_section_categories_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SectionCategory $section_category, SectionCategoryRepository $sectioncategoryRepository): Response
    {
        $form = $this->createForm(SectionCategoryType::class, $section_category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sectioncategoryRepository->add($section_category, true);

            return $this->redirectToRoute('app_sections', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/section_categories/edit.html.twig', [
            'section_category' => $section_category,
            'form' => $form,
        ]);
    }

    #[Route('/admin/section_categories/{id}', name: 'app_section_categories_delete', methods: ['POST'])]
    public function delete(Request $request, SectionCategory $section_category, SectionCategoryRepository $sectioncategoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$section_category->getId(), $request->request->get('_token'))) {
            $sectioncategoryRepository->remove($section_category, true);
        }

        return $this->redirectToRoute('app_section_categories', [], Response::HTTP_SEE_OTHER);
    }
}
