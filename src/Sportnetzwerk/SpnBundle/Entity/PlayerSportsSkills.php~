<?php
/* 
 * kdos: cross reference entity mapping Player with and Sports with Skilllevels
 */


namespace Sportnetzwerk\SpnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sportnetzwerk\SpnBundle\Entity\Skilllevels;
use Sportnetzwerk\SpnBundle\Entity\Sports;
use Sportnetzwerk\SpnBundle\Entity\Player;

/**
 * @ORM\Entity
 * @ORM\Table(name="player_sports_skills")
 */

class PlayerSportsSkills {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Skilllevels")
     * @ORM\JoinColumn(name="skilllevels_id", referencedColumnName="id")
     * 
     */
    protected $skilllevelsId;
    
    /**
     * @ORM\ManyToOne(targetEntity="Sports")
     * @ORM\JoinColumn(name="sports_id", referencedColumnName="id")
     * 
     */
    protected $sportsId;

    
    /**
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     * 
     */
    protected $playerId;
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
     * Set skilllevelsId
     *
     * @param \Sportnetzwerk\SpnBundle\Entity\Skilllevels $skilllevelsId
     * @return PlayerSportsSkills
     */
    public function setSkilllevelsId(\Sportnetzwerk\SpnBundle\Entity\Skilllevels $skilllevelsId = null)
    {
        $this->skilllevelsId = $skilllevelsId;

        return $this;
    }

    /**
     * Get skilllevelsId
     *
     * @return \Sportnetzwerk\SpnBundle\Entity\Skilllevels 
     */
    public function getSkilllevelsId()
    {
        return $this->skilllevelsId;
    }

    /**
     * Set sportsId
     *
     * @param \Sportnetzwerk\SpnBundle\Entity\Sports $sportsId
     * @return PlayerSportsSkills
     */
    public function setSportsId(\Sportnetzwerk\SpnBundle\Entity\Sports $sportsId = null)
    {
        $this->sportsId = $sportsId;

        return $this;
    }

    /**
     * Get sportsId
     *
     * @return \Sportnetzwerk\SpnBundle\Entity\Sports 
     */
    public function getSportsId()
    {
        return $this->sportsId;
    }

    /**
     * Set playerId
     *
     * @param \Sportnetzwerk\SpnBundle\Entity\Player $playerId
     * @return PlayerSportsSkills
     */
    public function setPlayerId(\Sportnetzwerk\SpnBundle\Entity\Player $playerId = null)
    {
        $this->playerId = $playerId;

        return $this;
    }

    /**
     * Get playerId
     *
     * @return \Sportnetzwerk\SpnBundle\Entity\Player 
     */
    public function getPlayerId()
    {
        return $this->playerId;
    }
}
