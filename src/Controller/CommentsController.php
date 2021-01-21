<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Form\CommentsType;
use App\Repository\CommentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentsController extends AbstractController{

    /**
     * @var PhotoRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(CommentsRepository $repository, EntityManagerInterface $em){
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/LivreDor", name="comments")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PaginatorInterface $paginator, Request $request):Response {

        $comments = $paginator->paginate(
            $this->repository->AllCommentsQuery(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
        return $this->render('pages/comments.html.twig', [
            'current_menu' => 'comments',
            'comments' => $comments
        ]);
    }

     /**
     * @Route("LivreDor/new", name="comment.new")
     */
    public function new(Request $request){
        $comment = new Comments();
        $form = $this->createForm(CommentsType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($comment);
            $this->em->flush();
            $this->addFlash('success', 'Commentaire ajouté avec succès');
            return $this->redirectToRoute('comments');
        }

        return $this->render('pages/newComment.html.twig', [
            'comment' => $comment,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/LivreDor/{id}", name="admin.comment.delete", methods="DElETE")
     * @param Comments $comment
     */
    public function delete(Comments $comment, Request $request) {
        if ($this->isCsrfTokenValid('delete' . $comment->getId(), $request->get('_token'))){
            $this->em->remove($comment);
            $this->em->flush();
            $this->addFlash('success', 'Commentaire supprimé avec succès');
        }
        return $this->redirectToRoute('comments');
    }
   
}
