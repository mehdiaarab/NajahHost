<?php

namespace NajahHost\ProfileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\User;

class DefaultController extends Controller
{
    
    public function profileAction($username)
    {
    	$user  = $this->getDoctrine()
        ->getRepository('UserBundle:User')
        ->findOneByUsername($username);
        return $this->render('ProfileBundle:Default:index.html.twig', array('user' => $user));
    }

   public function editProfileAction($username)
    {

    	$user = $this->getDoctrine()
    	->getRepository('UserBundle:User')
    	->findOneByUsername($username);

        return $this->render('ProfileBundle:Default:editProfile.html.twig', array('user' => $user));


    } 

}
