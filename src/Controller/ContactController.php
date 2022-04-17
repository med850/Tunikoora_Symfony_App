<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {

        $form = $this->createForm((ContactType::class));
        $contact = $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){

            $email = (new TemplatedEmail())
              ->from($contact->get('email')->getData())
              ->to('userjok9@gmail.com')
              ->htmlTemplate('emails/contact.html.twig')
              ->context([
                  'mail'=>$contact->get('email')->getData(),
                  'message'=>$contact->get('Message')->getData()
              ]);
                //dd($email);
              $mailer->send($email);

              return $this->redirectToRoute('app_home');
          //  $contact = $form->getData();

           // dd($contact);

        }



        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}
