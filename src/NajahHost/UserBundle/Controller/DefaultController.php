<?php

namespace NajahHost\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UserBundle:Default:index.html.twig', array('name' => $name));
    }

    public function listAllUsersAction()
    {
        $users = $this->getDoctrine()->getRepository('UserBundle:User')->findAll();
        return $this->render('UserBundle:Default:listAllUsers.html.twig', array('users' => $users));
    }



}
