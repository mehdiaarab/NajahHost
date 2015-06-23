<?php
/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 6/22/2015
 * Time: 19:27
 */

namespace NajahHost\UserBundle\Twig;


use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Security\Core\SecurityContext;
use \Twig_Extension;

class NotificationExtension extends  Twig_Extension {

    protected $doctrine;
    protected  $context;

    public function __construct(RegistryInterface $doctrine, SecurityContext $context)
    {
        $this->doctrine = $doctrine;
        $this->context = $context;
    }

    public function getGlobals()
    {
        $nb_ntf = array();
        if(is_object($this->context->getToken()->getUser())){

            $user = $this->context->getToken()->getUser();
            $nb_ntf = $this->doctrine->getRepository('UserBundle:Notification')->getNbNotifications($user->getId());

        }

        return array(
            'nb_notifications' => count($nb_ntf)
        );

    }


    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return "notifications_extension";
    }
}