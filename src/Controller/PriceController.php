<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PriceController extends AbstractController{

    /**
     * @Route("/Tarifs", name="price")
     * @return Response
     */
    public function index(Request $request, ContactNotification $notification):Response {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notification->notify($contact);
            $this->addFlash('success', 'Votre email a bien été envoyé');
            /* return $this->redirectToRoute('price'); */
        }
        return $this->render('pages/price.html.twig', [
            'current_menu' => 'price',
            'form' => $form->createView()
        ]);
    }

}
