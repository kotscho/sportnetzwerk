<?php
/**
 * Sports entity class
 * @author kdoskas
 * 
 */
namespace Sportnetzwerk\SpnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="sports")
 * @ORM\Entity(repositoryClass="Sportnetzwerk\SpnBundle\Entity\SportsRepository")
 */

class Sports
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $name;
    
    /**
     * @ORM\Column(type="integer")
     * 
     */
    protected $created;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Sportscategories", inversedBy="sports")
     * @ORM\JoinColumn(name="sports_category", referencedColumnName="id")
     */
    protected $sports_category;

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
     * @return Sports
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

    /**
     * Set created
     *
     * @param integer $created
     * @return Sports
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return integer 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set sports_category
     *
     * @param integer $sportsCategory
     * @return Sports
     */
    public function setSportsCategory($sportsCategory)
    {
        $this->sports_category = $sportsCategory;

        return $this;
    }

    /**
     * Get sports_category
     *
     * @return integer 
     */
    public function getSportsCategory()
    {
        return $this->sports_category;
    }
}
