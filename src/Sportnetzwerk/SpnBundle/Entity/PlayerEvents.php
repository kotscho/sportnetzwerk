<?php

/* 
 * kdos: cross reference entity mapping (participating )players and events
 */


namespace Sportnetzwerk\SpnBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sportnetzwerk\SpnBundle\Entity\Player;
use Sportnetzwerk\SpnBundle\Entity\Events;

/**
 * @ORM\Entity
 * @ORM\Table(name="player_events")
 * @ORM\Entity(repositoryClass="Sportnetzwerk\SpnBundle\Entity\PlayerEventsRepository")
 */

class PlayerEvents {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="pe")
     * @ORM\JoinColumn(name="player", referencedColumnName="id")
     * 
     */
    protected $player;
    
    /**
     * @ORM\ManyToOne(targetEntity="Events", inversedBy="pe")
     * @ORM\JoinColumn(name="event", referencedColumnName="id")
     * 
     */
    protected $event;
  
    /**
     * @ORM\Column(name="accepted", type="integer")
     */
    protected $accepted = 0;

    /**
     *
     * @ORM\Column(name="token", type="string")
     */
    protected $token;
    
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
     * Set player
     *
     * @param \Sportnetzwerk\SpnBundle\Entity\Player $player
     * @return PlayerEvents
     */
    public function setPlayer(\Sportnetzwerk\SpnBundle\Entity\Player $player = null)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return \Sportnetzwerk\SpnBundle\Entity\Players 
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set event
     *
     * @param \Sportnetzwerk\SpnBundle\Entity\Events $event
     * @return PlayerEvents
     */
    public function setEvent(\Sportnetzwerk\SpnBundle\Entity\Events $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \Sportnetzwerk\SpnBundle\Entity\Events 
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set accepted
     *
     * @param integer $accepted
     * @return PlayerEvents
     */
    public function setAccepted($accepted)
    {
        $this->accepted = $accepted;

        return $this;
    }

    /**
     * Get accepted
     *
     * @return integer 
     */
    public function getAccepted()
    {
        return $this->accepted;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return PlayerEvents
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }
}
