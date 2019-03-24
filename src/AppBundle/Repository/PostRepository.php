<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Post;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query;

class PostRepository extends EntityRepository
{

    /**
     * get all posts
     *
     * @return array
     */
    public function findAllPosts()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a
         FROM AppBundle:Post a
      
         ORDER BY a.posted_at DESC'
            )
            ->getArrayResult();
    }

    /**
     * get one by id
     *
     * @param integer $id
     *
     * @return array
     */
    public function findOneById($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT a, u.username
       FROM AppBundle:Annonce
       a JOIN a.user u
        WHERE a.id = id"
            )
            ->setParameter('id', $id)
            ->getArrayResult();
    }


    /**
     * get one by id
     *
     * @param integer $id
     *
     * @return object or null
     */
    public function findPostByid($id)
    {
        try {
            return $this->getEntityManager()
                ->createQuery(
                    "SELECT p
                FROM AppBundle:Post
                p WHERE p.id =:id"
                )
                ->setParameter('id', $id)
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }
    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM AppBundle:Post p
                WHERE p.title LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }

}
