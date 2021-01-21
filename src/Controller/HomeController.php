<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController{

    /**
     * @Route("/", name="home")
     * @param PhotoRepository $repository
     * @return Response
     */
    public function index(PhotoRepository $repository):Response
    {
        $mosaique = $repository->findMosaique();
        return $this->render('pages/home.html.twig' ,[
            'mosaique' => $mosaique
        ]);
    }

}