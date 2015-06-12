<?php

namespace NajahHost\ProfileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\User;

class DefaultController extends Controller {

    public function profileAction($username) {
        $user = $this->getDoctrine()
                ->getRepository('UserBundle:User')
                ->findOneByUsername($username);
        return $this->render('ProfileBundle:Default:index.html.twig', array('user' => $user));
    }

    public function editProfileAction($username) {

        $user = $this->getDoctrine()
                ->getRepository('UserBundle:User')
                ->findOneByUsername($username);

        $form = $this->createForm(new \NajahHost\UserBundle\Form\UserType(), $user);
        $request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
        $form->handleRequest($request);

        if ($form->isValid()) {

            try {
                $em = $this->getDoctrine()->getManager();
                $user = $form->getData();
                $em->persist($user);
                $em->flush();
                $session = $this->get('session')->getFlashBag()
                        ->add('success', 'les modification on été effectuer avec succés');
                return $this->redirect($this->generateUrl('profile', array('username' => $user->getUsername())));
            } catch (Exception $ex) {
                $session = $this->get('session')->getFlashBag()->add('danger'
                        , 'Erreur lors de la modification du profile');
                return $this->redirect($this->generateUrl('edit_profile',
                        array('username' => $user->getUsername())));
            }
        }

        return $this->render('ProfileBundle:Default:editProfile.html.twig', array('user' => $user, 'form' => $form->createView()));
    }

}
