<?php

namespace App\Controller\Admin;

use App\Entity\Photo;
use App\Form\PhotoType;
use App\Entity\PhotoSearch;
use App\Form\PhotoSearchType;
use App\Repository\PhotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController{

    /**
     * @var PhotoRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PhotoRepository $repository, EntityManagerInterface $em){
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin", name="admin.photo.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PaginatorInterface $paginator, Request $request) {
        $search = new PhotoSearch();
        $form = $this->createForm(PhotoSearchType::class, $search);
        $form->handleRequest($request);

        $photos = $paginator->paginate(
            $this->repository->allPhotosQuery($search), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->render('admin/index.html.twig', [
            'photos' => $photos,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/photo/create", name="admin.photo.new")
     */
    public function new(Request $request){
        $photo = new Photo();
        $form = $this->createForm(PhotoType::class, $photo);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($photo);
            $this->em->flush();
            $this->addFlash('success', 'Photo ajoutée avec succès');
            return $this->redirectToRoute('admin.photo.index');
        }

        return $this->render('admin/new.html.twig', [
            'photo' => $photo,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/photo/{id}", name="admin.photo.edit", methods="GET|POST")
     * @param Photo $photo
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Photo $photo, Request $request){
        $form = $this->createForm(PhotoType::class, $photo);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Photo modifiée avec succès');
            return $this->redirectToRoute('admin.photo.index');
        }

        return $this->render('admin/edit.html.twig', [
            'photo' => $photo,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/photo/{id}", name="admin.photo.delete", methods="DElETE")
     * @param Photo $photo
     */
    public function delete(Photo $photo, Request $request) {
        if ($this->isCsrfTokenValid('delete' . $photo->getId(), $request->get('_token'))){
            $this->em->remove($photo);
            $this->em->flush();
            $this->addFlash('success', 'Photo supprimée avec succès');
        }
        return $this->redirectToRoute('admin.photo.index');
    }

}

