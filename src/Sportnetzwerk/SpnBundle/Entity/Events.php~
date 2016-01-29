<?php

namespace Sportnetzwerk\SpnBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks 
 * @ORM\Table(name="events")
 * @ORM\Entity(repositoryClass="Sportnetzwerk\SpnBundle\Entity\EventsRepository")
 */

class Events
{
     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity="Sports")
     * @ORM\JoinColumn(name="sports_id", referencedColumnName="id")
     */
    protected $sports_id;
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity="Locations")
     * @ORM\JoinColumn(name="locations_id", referencedColumnName="id")
     */
    protected $locations_id;
    
    /**
     *
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="initiator", referencedColumnName="id")
     */
    protected $initiator;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $start;
    
     /**
     * @ORM\Column(type="integer")
     */
    protected $end;
    
     /**
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity="Skilllevels")
     * @ORM\JoinColumn(name="skill_levels_id", referencedColumnName="id")
     */
    protected $skill_levels_id;
    
    
     /**
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity="Gender")
     * @ORM\JoinColumn(name="gender", referencedColumnName="id")
     */
    protected $gender;
    
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $num_of_players;
    
    
    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $zip_area;
    
    /**
     * @ORM\Column(type="string", length=4)
     */
    protected $autoselect;
    
     /**
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity="Eventstatus")
     * @ORM\JoinColumn(name="event_status", referencedColumnName="id")
     */
    protected $event_status;

    /**
     * @ORM\Column(type="string", length=400, nullable=true)
     */
    protected $notes;
    
    /**
     * pe stands for player event
     * @ORM\OneToMany(targetEntity="PlayerEvents", mappedBy="event", cascade={"all"}) 
     */
    protected $pe;
    
    
    protected $players;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $created;
    
    
    public function __construct() 
    {
        $this->pe = new \Doctrine\Common\Collections\ArrayCollection();
        $this->players = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('sports_id', new Assert\NotBlank());
        $metadata->addPropertyConstraint('locations_id', new Assert\NotBlank());
        $metadata->addPropertyConstraint('locations_id', new Assert\Regex(
                array(
                    'pattern' => "/^d*$/",
                    'match' => false,
                    'message' => 'The provided value must be numeric'
                )
                ));
        
        $metadata->addPropertyConstraint('start', new Assert\NotBlank());
        $metadata->addPropertyConstraint('end', new Assert\NotBlank());
        $metadata->addPropertyConstraint('zip_area', new Assert\NotBlank());
        $metadata->addPropertyConstraint('zip_area', new Assert\Regex(
                array(
                    'pattern' => "/^d*$/",
                    'match' => false,
                    'message' => 'The provided value must be numeric'
                )
                ));
        
        $metadata->addPropertyConstraint('num_of_players', new Assert\NotBlank());
        $metadata->addPropertyConstraint('num_of_players', new Assert\Regex(
                array(
                    'pattern' => "/^d*$/",
                    'match' => false,
                    'message' => 'The provided value must be numeric'
                )
                ));
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
     * Set sports_id
     *
     * @param integer $sportsId
     * @return Events
     */
    public function setSportsId($sportsId)
    {
        $this->sports_id = $sportsId;

        return $this;
    }

    /**
     * Get sports_id
     *
     * @return integer 
     */
    public function getSportsId()
    {
        return $this->sports_id;
    }

    /**
     * Set locations_id
     *
     * @param integer $locationsId
     * @return Events
     */
    public function setLocationsId($locationsId)
    {
        $this->locations_id = $locationsId;

        return $this;
    }

    /**
     * Get locations_id
     *
     * @return integer 
     */
    public function getLocationsId()
    {
        return $this->locations_id;
    }

    /**
     * Set start
     *
     * @param integer $start
     * @return Events
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return integer 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param integer $end
     * @return Events
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return integer 
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set skill_levels_id
     *
     * @param integer $skillLevelsId
     * @return Events
     */
    public function setSkillLevelsId($skillLevelsId)
    {
        $this->skill_levels_id = $skillLevelsId;

        return $this;
    }

    /**
     * Get skill_levels_id
     *
     * @return integer 
     */
    public function getSkillLevelsId()
    {
        return $this->skill_levels_id;
    }

    /**
     * Set gender
     *
     * @param integer $gender
     * @return Events
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return integer 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set num_of_players
     *
     * @param integer $numOfPlayers
     * @return Events
     */
    public function setNumOfPlayers($numOfPlayers)
    {
        $this->num_of_players = $numOfPlayers;

        return $this;
    }

    /**
     * Get num_of_players
     *
     * @return integer 
     */
    public function getNumOfPlayers()
    {
        return $this->num_of_players;
    }

    /**
     * Set zip_area
     *
     * @param string $zipArea
     * @return Events
     */
    public function setZipArea($zipArea)
    {
        $this->zip_area = $zipArea;

        return $this;
    }

    /**
     * Get zip_area
     *
     * @return string 
     */
    public function getZipArea()
    {
        return $this->zip_area;
    }

    /**
     * Set autoselect
     *
     * @param string $autoselect
     * @return Events
     */
    public function setAutoselect($autoselect)
    {
        $this->autoselect = $autoselect;

        return $this;
    }

    /**
     * Get autoselect
     *
     * @return string 
     */
    public function getAutoselect()
    {
        return $this->autoselect;
    }

    /**
     * Set event_status
     *
     * @param integer $eventStatus
     * @return Events
     */
    public function setEventStatus($eventStatus)
    {
        $this->event_status = $eventStatus;

        return $this;
    }

    /**
     * Get event_status
     *
     * @return integer 
     */
    public function getEventStatus()
    {
        return $this->event_status;
    }

    /**
     * Set notes
     *
     * @param string $notes
     * @return Events
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string 
     */
    public function getNotes()
    {
        return $this->notes;
    }
    

    /**
     * Set initiator
     *
     * @param integer $initiator
     * @return Events
     */
    public function setInitiator($initiator)
    {
        $this->initiator = $initiator;

        return $this;
    }

    /**
     * Get initiator
     *
     * @return integer 
     */
    public function getInitiator()
    {
        return $this->initiator;
    }
  
    public function getPlayer()
    {
        $players = new ArrayCollection();
        foreach($this->pe as $p)
        {
            $players[] = $p->getPlayer();
        }
        return $players;
    }
    
    public function setPlayer($players)
    {
        foreach ($players as $p){
            $pl = new PlayerEvents();
            $pl->setEvent($this);
            $pl->setPlayer($p);
            
            $this->addPe($pl);
        }
    }
    
    public function addPe($PlayerEvent)
    {
        $this->pe[] = $PlayerEvent;
    }
    
    public function removePe($PlayerEvent)
    {
        return $this->pe->removeElement($PlayerEvent);
    }

    

    /**
     * Get pe
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPe()
    {
        return $this->pe;
    }
    
    /** 
     * @ORM\PrePersist 
     */
    public function doOnPrePersist()
    {
        $this->created = time();
    }

    /**
     * Set created
     *
     * @param integer $created
     * @return Events
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
}
