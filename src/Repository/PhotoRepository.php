<?php

namespace App\Repository;

use App\Entity\Photo;
use Doctrine\ORM\Query;
use App\Entity\PhotoSearch;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Photo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Photo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Photo[]    findAll()
 * @method Photo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Photo::class);
    }

     /**
     * @return Photo[] //retourne toutes les photos du thème de l'id correspondant et ajouter de manière décroissante.
     */
    public function findByTheme($theme): array{
        return $this->findPhotoByDate()
            ->where ('p.theme = :theme')
            ->setParameter('theme', $theme)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Photo[] //retourne une photo d'un thème en bdd
     */
    public function findOneByTheme($theme): array{
        return $this->createQueryBuilder('p')
            ->where ('p.theme = :theme')
            ->setParameter('theme', $theme)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

    /**
     * récupère une photo de titre selon le la l'endroit du titre et du thème renseignés
     */
    public function findHeader($title, $theme) :array {
        return $this->findPhotoByDate()
            ->where ('p.header = :title')
            ->setParameter('title', $title)
            ->andWhere ('p.theme = :theme')
            ->setParameter('theme', $theme)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Photo[] // Retourne les photos qui font partie de la mosaique de photo en page d'accueil classées par date décroissante
     */
    public function findMosaique(){
        return $this->findPhotoByDate()
            ->Where('p.header = 5')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
    
     /**
     * @return Query
     */
    public function allPhotosQuery(PhotoSearch $search) :Query{
        $query = $this->findPhotoByDate();

        if($search->getTheme()) {
            $query = $query
                ->andWhere('p.theme = :theme')
                ->setParameter('theme', $search->getTheme());
        }

        if($search->getHeader()) {
            $query = $query
                ->andWhere('p.header = :header')
                ->setParameter('header', $search->getHeader());
        }
            return $query->getQuery();
    }

    /**
     * retourne la requete qui recupère les photos par date décroissante
     */
    private function findPhotoByDate(): QueryBuilder {
        return $this->createQueryBuilder('p')
            ->orderBy('p.createdAt', 'DESC');
    }
}   
