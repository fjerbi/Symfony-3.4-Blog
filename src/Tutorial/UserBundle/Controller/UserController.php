<?php

namespace Tutorial\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{

    public function adminAction(Request $request)
    {

        return $this->render('@TutorialUser/Admin/base2.html.twig');
    }
}
