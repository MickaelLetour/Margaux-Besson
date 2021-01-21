<?php 
namespace App\Notification;

use Twig\Environment;
use App\Entity\Contact;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactNotification extends AbstractController{

    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(MailerInterface $mailer, Environment $renderer){
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    /**
     * permet l'envoie de l email contenant un rendu d'un fichier twig
     */
    public function notify(Contact $contact){
        $message = (new Email())
            ->from($contact->getEmail()) 
            ->to('margaux.besson@besson-photographe.com')
            ->html($this->renderer->render('emails/contact.html.twig', [
                'contact' => $contact
                ]), 'text/html');
            $this->mailer->send($message);
    }

}