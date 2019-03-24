<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Postcomment;
use AppBundle\Entity\Post;

class PostcommentRepository extends EntityRepository
{

    /**
     * get post postcomment
     *
     * @param integer $post_id
     *
     * @return array
     */
    public function getPostComments($post_id){
        return $this->getEntityManager()
            ->createQuery(
                "SELECT c, u.username
       FROM AppBundle:Postcomment c
       JOIN c.user u
       WHERE c.post = :id"
            )
            ->setParameter('id', $post_id)
            ->getArrayResult();
    }

}
