<?php

namespace Tutorial\BlogBundle\Controller;
use AppBundle\Entity\Post;
use Tutorial\BlogBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{

    public function addAction(Request $request)
    {
        $post = new Post();
        $form= $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $file = $post->getPhoto();
            $filename= md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('photos_directory'), $filename);
            $post->setPhoto($filename);
            $post->setPostdate(new \DateTime('now'));

            $em->persist($post);
            $em->flush();

            $this->addFlash('info', 'Created Successfully !');
        }
        return $this->render('@TutorialBlog/Post/add.html.twig', array(
            "Form"=> $form->createView()
        ));
    }

public function listpostAction(Request $request)
{

$em=$this->getDoctrine()->getManager();
$posts=$em->getRepository('AppBundle:Post')->findAll();
    return $this->render('@TutorialBlog/Post/list.html.twig', array(
        "posts" =>$posts
    ));

}
public function updatepostAction(Request $request, $id)
{
    $em=$this->getDoctrine()->getManager();
    $p= $em->getRepository('AppBundle:Post')->find($id);
    $form=$this->createForm(PostType::class,$p);
    $form->handleRequest($request);
    if($form->isSubmitted()){
        $file = $p->getPhoto();
        $filename= md5(uniqid()) . '.' . $file->guessExtension();
        $file->move($this->getParameter('photos_directory'), $filename);
        $p->setPhoto($filename);
        $p->setPostdate(new \DateTime('now'));
        $em= $this->getDoctrine()->getManager();
        $em->persist($p);
        $em->flush();
        return $this->redirectToRoute('list_post');

    }
    return $this->render('@TutorialBlog/Post/update.html.twig', array(
        "form"=> $form->createView()
    ));
}

public function deletepostAction(Request $request)
{
    $id = $request->get('id');
    $em= $this->getDoctrine()->getManager();
    $Post=$em->getRepository('AppBundle:Post')->find($id);
    $em->remove($Post);
    $em->flush();
    return $this->redirectToRoute('list_post');
}
public function showdetailedAction($id)
{
    $em= $this->getDoctrine()->getManager();
    $p=$em->getRepository('AppBundle:Post')->find($id);
    return $this->render('@TutorialBlog/Post/detailedpost.html.twig', array(
        'title'=>$p->getTitle(),
        'date'=>$p->getPostdate(),
        'photo'=>$p->getPhoto(),
        'descripion'=>$p->getDescription(),
        'id'=>$p->getId()
    ));
}
}