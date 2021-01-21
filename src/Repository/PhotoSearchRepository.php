<?php

namespace App\Repository;

use App\Entity\PhotoSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PhotoSearch|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotoSearch|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotoSearch[]    findAll()
 * @method PhotoSearch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoSearchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhotoSearch::class);
    }

}
