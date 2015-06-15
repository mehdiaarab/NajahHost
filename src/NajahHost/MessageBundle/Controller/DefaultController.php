<?php

namespace NajahHost\MessageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('MessageBundle:Default:index.html.twig');
    }

    public function sendMessageAction($username)
    {


        $form = $this->createFormBuilder()
            ->add('subject', 'text')
            ->add('body', 'textarea')
            ->getForm();

        $request = Request::createFromGlobals();
        $form->handleRequest($request);

        if ($form->isValid()) {

            try {
                $composer = $this->container->get('fos_message.composer');
                $sender = $this->container->get('fos_message.sender');

                $recipient = $this->getDoctrine()->getRepository('UserBundle:User')->findOneByUsername($username);
                $subject = $this->get('request')->request->get('subject');
                $body = $this->get('request')->request->get('body');

                $message = $composer
                    ->newThread()
                    ->setSender($this->getUser())
                    ->addRecipient($recipient)
                    ->setSubject($subject)
                    ->setBody($body)
                    ->getMessage();

                $session = $this->get('session')->getFlashBag()->add('success'
                    , 'votre message a été envoyer avec succès');
                return $this->redirect($this->generateUrl('messages'));

            } catch (\Exception $e) {

                $session = $this->get('session')->getFlashBag()->add('danger'
                    , 'Erreur lors de l\'envoie de votre message');
                return $this->redirect($this->generateUrl('send_message',
                    array('username' => $username)
                ));

            }


        }

        return $this->render('MessageBundle:Default:sendMessage.html.twig',
            array('username' => $username, 'form' => $form->createView()));
    }

}
