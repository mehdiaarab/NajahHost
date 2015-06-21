<?php

namespace NajahHost\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	public function indexAction()
	{

		return $this->render('GeneralBundle:Default:index.html.twig');
	}

    public function panel_chefAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->get('security.context')->getToken()->getUser();
        $projects = $em->getRepository('ProjetBundle:Projet')->findBy(array('chefProjet'=>$user));

        $provider = $this->container->get('fos_message.provider');
        $threads = $provider->getInboxThreads();

        return $this->render('GeneralBundle:Default:panel_chef_projet.html.twig',
            array('projects' => $projects, 'threads' => $threads)
        );
    }
    
}
