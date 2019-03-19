<?php


namespace AppBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;


/**
 * Postcomment
 *
 * @ORM\Table(name="postcomment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 */

class Postcomment
{


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="postdate", type="date")
     */
    private $posted_at;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime
     */
    public function getPostedAt()
    {
        return $this->posted_at;
    }

    /**
     * @param \DateTime $posted_at
     */
    public function setPostedAt($posted_at)
    {
        $this->posted_at = $posted_at;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Post", inversedBy="comment")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $post;

}
