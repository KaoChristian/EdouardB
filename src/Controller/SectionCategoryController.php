<?php

namespace App\Controller;

use App\Entity\SectionCategory;
use App\Form\SectionCategoryType;
use App\Repository\SectionCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/section/category')]
class SectionCategoryController extends AbstractController
{
    #[Route('/', name: 'app_section_category_index', methods: ['GET'])]
    public function index(SectionCategoryRepository $sectionCategoryRepository): Response
    {
        return $this->render('section_category/index.html.twig', [
            'section_categories' => $sectionCategoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_section_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SectionCategoryRepository $sectionCategoryRepository): Response
    {
        $sectionCategory = new SectionCategory();
        $form = $this->createForm(SectionCategoryType::class, $sectionCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sectionCategoryRepository->add($sectionCategory, true);

            return $this->redirectToRoute('app_section_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('section_category/new.html.twig', [
            'section_category' => $sectionCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_section_category_show', methods: ['GET'])]
    public function show(SectionCategory $sectionCategory): Response
    {
        return $this->render('section_category/show.html.twig', [
            'section_category' => $sectionCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_section_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SectionCategory $sectionCategory, SectionCategoryRepository $sectionCategoryRepository): Response
    {
        $form = $this->createForm(SectionCategoryType::class, $sectionCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sectionCategoryRepository->add($sectionCategory, true);

            return $this->redirectToRoute('app_section_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('section_category/edit.html.twig', [
            'section_category' => $sectionCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_section_category_delete', methods: ['POST'])]
    public function delete(Request $request, SectionCategory $sectionCategory, SectionCategoryRepository $sectionCategoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sectionCategory->getId(), $request->request->get('_token'))) {
            $sectionCategoryRepository->remove($sectionCategory, true);
        }

        return $this->redirectToRoute('app_section_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
