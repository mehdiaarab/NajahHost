<?php

namespace NajahHost\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	public function indexAction()
	{

		return $this->render('GeneralBundle:Default:index.html.twig');
	}
}
