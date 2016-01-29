<?php

/**
 * Sportscategories entity class
 * @author kdoskas
 * 
 */
namespace Sportnetzwerk\SpnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="sports_categories")
 * @ORM\Entity(repositoryClass="Sportnetzwerk\SpnBundle\Entity\SportscategoriesRepository")
 */

class Sportscategories
{
     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $name;
    
    /**
     * @ORM\OneToMany(targetEntity="Sports", mappedBy="sports_category")
     */
    protected $sports = array();
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sports = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Sportscategories
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    public function getSports()
    {
        return $this->sports;
    }
    

    /**
     * Add sports
     *
     * @param \Sportnetzwerk\SpnBundle\Entity\Sports $sports
     * @return Sportscategories
     */
    public function addSports(\Sportnetzwerk\SpnBundle\Entity\Sports $sports)
    {
        $this->sports[] = $sports;

        return $this;
    }

    /**
     * Remove sports
     *
     * @param \Sportnetzwerk\SpnBundle\Entity\Sports $sports
     */
    public function removeSports(\Sportnetzwerk\SpnBundle\Entity\Sports $sports)
    {
        $this->sports->removeElement($sports);
    }

    /**
     * Add sports
     *
     * @param \Sportnetzwerk\SpnBundle\Entity\Sports $sports
     * @return Sportscategories
     */
    public function addSport(\Sportnetzwerk\SpnBundle\Entity\Sports $sports)
    {
        $this->sports[] = $sports;

        return $this;
    }

    /**
     * Remove sports
     *
     * @param \Sportnetzwerk\SpnBundle\Entity\Sports $sports
     */
    public function removeSport(\Sportnetzwerk\SpnBundle\Entity\Sports $sports)
    {
        $this->sports->removeElement($sports);
    }
}
