<?php

namespace najahhost\ProjetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Projet
 * @ORM\Entity
 * @ORM\Table()
 */
class Projet
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
     * @ORM\ManyToOne(targetEntity="\najahhost\UserBundle\Entity\User")
     */
    private $chefProjet;

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
     * @Assert\Image(
     *     maxWidth = 1000,
     *     maxHeight = 1000
     * )
     */
    protected $cover;

    /**
     * @return mixed
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param mixed $cover
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
    }

    /**
     * @return mixed
     */
    public function getTaches()
    {
        return $this->taches;
    }

    /**
     * @param mixed $taches
     */
    public function setTaches($taches)
    {
        $this->taches = $taches;
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
     * @return mixed
     */
    public function getChefProjet()
    {
        return $this->chefProjet;
    }

    /**
     * @param mixed $chefProjet
     */
    public function setChefProjet($chefProjet)
    {
        $this->chefProjet = $chefProjet;
    }


    /**
     * Set titre
     *
     * @param string $titre
     * @return Projet
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

    /**
     * Set description
     *
     * @param string $description
     * @return Projet
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateD
     *
     * @param \DateTime $dateD
     * @return Projet
     */
    public function setDateD($dateD)
    {
        $this->dateD = $dateD;

        return $this;
    }

    /**
     * Get dateD
     *
     * @return \DateTime 
     */
    public function getDateD()
    {
        return $this->dateD;
    }

    /**
     * Set dateF
     *
     * @param \DateTime $dateF
     * @return Projet
     */
    public function setDateF($dateF)
    {
        $this->dateF = $dateF;

        return $this;
    }

    /**
     * Get dateF
     *
     * @return \DateTime 
     */
    public function getDateF()
    {
        return $this->dateF;
    }
}
