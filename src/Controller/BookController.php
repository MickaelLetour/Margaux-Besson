<?php

namespace App\Controller;

use App\Repository\PhotoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController{

    /**
     * @var PhotoRepository
     */
    private $repository;

    public function __construct(PhotoRepository $repository){
        $this->repository = $repository;
    }

    /**
     * @Route("/Portfolio", name="book")
     * @return Response
     */
    public function index() :Response {
        for ($i=1; $i<4; $i++){
            $titles[$i] = $this->repository->findHeader(2, $i);
        }
        return $this->render('pages/book.html.twig' , [
            'current_menu' => 'book', 
            'titles' => $titles
        ]);
    }

    /**
     * @Route("/Portfolio/{slug}-{theme}", name="photo.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show($slug, $theme): Response {
        
        $photo = $this->repository->findOneByTheme($theme);
        if ($photo[0]->getSlug() !== $slug){
            return $this->redirectToRoute('photo.show', [
                'theme' => $photo[0]->getTheme(),
                'slug' => $photo[0]->getSlug()
            ], 301);
        }
        $photos = $this->repository->findByTheme($theme);
        return $this->render('pages/show.html.twig', [
            'photos' => $photos
        ]);
    }

}
