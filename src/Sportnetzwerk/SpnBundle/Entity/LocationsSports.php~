<?php

/* 
 * kdos: cross reference entity mapping locations with sports
 */


namespace Sportnetzwerk\SpnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sportnetzwerk\SpnBundle\Entity\Locations;
use Sportnetzwerk\SpnBundle\Entity\Sports;

/**
 * @ORM\Entity
 * @ORM\Table(name="locations_sports")
 * @ORM\Entity(repositoryClass="Sportnetzwerk\SpnBundle\Entity\LocationsSportsRepository")
 */

class LocationsSports {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Locations", inversedBy="locations_sports")
     * @ORM\JoinColumn(name="locations_id", referencedColumnName="id")
     * 
     */
    protected $locationsId;
    
    /**
     * @ORM\ManyToOne(targetEntity="Sports", inversedBy="locations_sports")
     * @ORM\JoinColumn(name="sports_id", referencedColumnName="id")
     * 
     */
    protected $sportsId;
    
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
     * Set locations_id
     *
     * @param integer $locationsId
     * @return LocationsSports
     */
    public function setLocationsId($locationsId)
    {
        $this->locationsId = $locationsId;

        return $this;
    }

    /**
     * Get locations_id
     * @param integer $sportsId
     * @return integer 
     */
    public function getLocationsId()
    {
        return $this->locationsId;
    }

    /**
     * Set sports_id
     *
     * @param integer $sportsId
     * @return LocationsSports
     */
    public function setSportsId($sportsId)
    {
        $this->sportsId = $sportsId;

        return $this;
    }

    /**
     * Get sports_id
     *
     * @return integer 
     */
    public function getSportsId()
    {
        return $this->sportsId;
    }
}
