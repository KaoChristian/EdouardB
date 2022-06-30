<?php

namespace App\Controller;


use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use App\Repository\InfoRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;


class ContactController extends AbstractController
{
    #[Route('contact', name: 'app_contact')]
    public function index(InfoRepository $infoRepository, ContactRepository $contactRepository, Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {

            $contactRepository->add($contact, true);

                //Email
                $email = (new TemplatedEmail())
                ->from($contact->getEmail())
                ->to('edouardb-noisy@gmail.com')
                ->subject($contact->getSubject())
                ->htmlTemplate('emails/contact.html.twig')

                // Set variables (name => value) to the template
                ->context([
                    'contact' => $contact
                ]);

                $mailer->send($email);
                
                $this->addFlash(
                    'success',
                    'Votre demande a été envoyé avec succès !'
                );

            return $this->redirectToRoute('app_contact', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contact.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView(),
            'infos' => $infoRepository->findAll(),
        ]);
    }
}
