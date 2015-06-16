<?php

namespace NajahHost\MessageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function indexAction()
    {
        $provider = $this->container->get('fos_message.provider');
        $threads = $provider->getInboxThreads();
        return $this->render('MessageBundle:Default:index.html.twig',
            array('threads' => $threads));
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
                $data = $form->getData();

                $message = $composer
                    ->newThread()
                    ->setSender($this->getUser())
                    ->addRecipient($recipient)
                    ->setSubject($data['subject'])
                    ->setBody($data['body'])
                    ->getMessage();

                $sender->send($message);

                $session = $this->get('session')->getFlashBag()->add('success'
                    , 'votre message a été envoyer avec succès');
                return $this->redirect($this->generateUrl('messages'));

            } catch (\Exception $e) {
                ladybug_dump($data);
                ladybug_dump($e);
                /* $session = $this->get('session')->getFlashBag()->add('danger'
                    , 'Erreur lors de l\'envoie de votre message');
               return $this->redirect($this->generateUrl('send_message',
                    array('username' => $username)
                ));*/

            }


        }

        return $this->render('MessageBundle:Default:sendMessage.html.twig',
            array('username' => $username, 'form' => $form->createView()));
    }



}
