<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AboutController extends AbstractController{

    /**
     * @Route("/A.Propos", name="about")
     * @return Response
     */
    public function index():Response {
        return $this->render('pages/about.html.twig', [
            'current_menu' => 'about'
        ]);
    }

}

