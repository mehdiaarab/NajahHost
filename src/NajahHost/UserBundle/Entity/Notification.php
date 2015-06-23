<?php

namespace NajahHost\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="NajahHost\UserBundle\Entity\NotificationRepository")
 */
class Notification
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="\najahhost\ProjetBundle\Entity\Tache")
     */
    private $tache;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_read", type="boolean")
     */
    private $is_read;

    /**
     * @ORM\ManyToMany(targetEntity="\najahhost\UserBundle\Entity\User")
     */
    private $user;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Set tache
     *
     * @param \najahhost\ProjetBundle\Entity\Tache $tache
     * @return Notification
     */
    public function setTache($tache = null)
    {
        $this->tache = $tache;
        return $this;
    }

    /**
     * Get tache
     *
     * @return \najahhost\ProjetBundle\Entity\Tache 
     */
    public function getTache()
    {
        return $this->tache;
    }

   
    /**
     * Set is_read
     *
     * @param boolean $isRead
     * @return Notification
     */
    public function setIsRead($isRead)
    {
        $this->is_read = $isRead;

        return $this;
    }

    /**
     * Get is_read
     *
     * @return boolean 
     */
    public function getIsRead()
    {
        return $this->is_read;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setIsRead(false);
    }

    /**
     * Add user
     *
     * @param \najahhost\UserBundle\Entity\User $user
     * @return Notification
     */
    public function addUser(\najahhost\UserBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \najahhost\UserBundle\Entity\User $user
     */
    public function removeUser(\najahhost\UserBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUser()
    {
        return $this->user;
    }
}
