<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Post;
use Doctrine\ORM\Query;

class PostRepository extends EntityRepository
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
        ->createQuery(
            "SELECT p
            FROM AppBundle:Post
            p WHERE p.id =:id"
        )
        ->setParameter('id', $id)
        ->getOneOrNullResult();
}
}