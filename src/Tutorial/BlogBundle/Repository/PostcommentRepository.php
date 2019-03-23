<?php

namespace BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Post;
use Doctrine\ORM\Query;

class PostcommentRepository extends EntityRepository
{

    public function findEntitiesByString($str)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
            FROM AppBundle:Post p
            WHERE p.title LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }
    public function findPostByid($id)
    {
        return $this->getEntityManager()
            ->createQuery("SELECT p FROM AppBundle:Post p WHERE p.id = :id")
            ->setParameter('id',$id)
            ->getOneOrNullResult();

    }

    /**
     * get annonce commentaireannonce
     *
     * @param integer $annonce_id
     *
     * @return array
     */
    public function getPostComments($annonce_id){
        return $this->getEntityManager()
            ->createQuery(
                "SELECT c, u.username
       FROM AppBundle:Commentaireannonce c
       JOIN c.user u
       WHERE c.annonce = :id"
            )
            ->setParameter('id', $annonce_id)
            ->getArrayResult();
    }
}