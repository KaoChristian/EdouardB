<?php

namespace App\Controller;

use App\Entity\Gallery;
use App\Form\GalleryType;
use App\Repository\GalleryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminGalleryController extends AbstractController
{
    #[Route('/admin/gallery', name: 'app_gallery')]
    public function index(GalleryRepository $galleryRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/gallery/index.html.twig', [
            'galleries' => $galleryRepository->findAll(),
        ]);
    }

    #[Route('/admin/galleries/new', name: 'app_sections_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GalleryRepository $sectionRepository): Response
    {
        $gallery = new Gallery();
        $form = $this->createForm(SectionType::class, $gallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sectionRepository->add($gallery, true);

            return $this->redirectToRoute('app_galleries', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/galleries/new.html.twig', [
            'gallery' => $gallery,
            'form' => $form,
        ]);
    }

    #[Route('/admin/galleries/{id}/edit', name: 'app_sections_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Gallery $gallery, GalleryRepository $galleryRepository): Response
    {
        $form = $this->createForm(SectionType::class, $gallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $galleryRepository->add($gallery, true);

            return $this->redirectToRoute('app_galleries', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/galleries/edit.html.twig', [
            'gallery' => $gallery,
            'form' => $form,
        ]);
    }

    #[Route('/admin/galleries/{id}', name: 'app_sections_delete', methods: ['POST'])]
    public function delete(Request $request, Gallery $gallery, GalleryRepository $galleryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gallery->getId(), $request->request->get('_token'))) {
            $galleryRepository->remove($gallery, true);
        }

        return $this->redirectToRoute('app_galleries', [], Response::HTTP_SEE_OTHER);
    }
}
