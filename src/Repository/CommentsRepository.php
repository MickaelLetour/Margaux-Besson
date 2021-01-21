<?php

namespace App\Repository;

use Doctrine\ORM\Query;
use App\Entity\Comments;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Comments|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comments|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comments[]    findAll()
 * @method Comments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comments::class);
    }

    /**
     * recupère tout les commentaires en bdd
     */
    public function AllCommentsQuery(): Query{
        return $this->createQueryBuilder('p')
            ->select('p.id','p.name', 'p.comment', "DATE_FORMAT(p.createdAt,'%d-%m-%Y') as date")
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery();
    }
    
}
