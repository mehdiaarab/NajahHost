<?php

namespace najahhost\ProjetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tache
 * @ORM\Entity
 * @ORM\Table()
 */
class Tache
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
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateD", type="date")
     */
    private $dateD;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateF", type="date")
     */
    private $dateF;
    /**
     * @ORM\ManyToMany(targetEntity="\najahhost\UserBundle\Entity\user")
     **/
    private $employes;

    /**
     * @return mixed
     */
    public function getEmployes()
    {
        return $this->employes;
    }

    /**
     * @param mixed $employes
     */
    public function setEmployes($employes)
    {
        $this->employes = $employes;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getDateD()
    {
        return $this->dateD;
    }

    /**
     * @param \DateTime $dateD
     */
    public function setDateD($dateD)
    {
        $this->dateD = $dateD;
    }

    /**
     * @return \DateTime
     */
    public function getDateF()
    {
        return $this->dateF;
    }

    /**
     * @param \DateTime $dateF
     */
    public function setDateF($dateF)
    {
        $this->dateF = $dateF;
    }



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
     * Set titre
     *
     * @param string $titre
     * @return Tache
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }
}
