<?php

namespace App\Controller;

use App\Entity\Carousel;
use App\Form\CarouselType;
use App\Repository\CarouselRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCarouselController extends AbstractController
{
    #[Route('/admin/carousel', name: 'admin_carousel')]
    public function index(CarouselRepository $carouselRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('admin/carousel/index.html.twig', [
            'carousels' => $carouselRepository->findAll(),
        ]);
    }

    #[Route('/admin/carousel/new', name: 'admin_carousel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CarouselRepository $carouselRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $carousel = new Carousel();
        $form = $this->createForm(CarouselType::class, $carousel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carouselRepository->add($carousel, true);

            return $this->redirectToRoute('admin_carousel', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/carousel/new.html.twig', [
            'carousel' => $carousel,
            'form' => $form,
        ]);
    }

    #[Route('/admin/carousel/{id}/edit', name: 'admin_carousel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Carousel $carousel, CarouselRepository $carouselRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $form = $this->createForm(CarouselType::class, $carousel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carouselRepository->add($carousel, true);

            return $this->redirectToRoute('admin_carousel', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/carousel/edit.html.twig', [
            'carousel' => $carousel,
            'form' => $form,
        ]);
    }

    #[Route('/admin/carousel/{id}', name: 'admin_carousel_delete', methods: ['POST'])]
    public function delete(Request $request, Carousel $carousel, CarouselRepository $carouselRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        if ($this->isCsrfTokenValid('delete'.$carousel->getId(), $request->request->get('_token'))) {
            $carouselRepository->remove($carousel, true);
        }

        return $this->redirectToRoute('admin_carousel', [], Response::HTTP_SEE_OTHER);
    }
}
