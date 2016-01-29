<?php
/**
 * Player entity class
 * @author kdoskas
 * 
 */
namespace Sportnetzwerk\SpnBundle\Entity;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\EncoderAwareInterface;


/**
 * @ORM\Entity
 * @ORM\Table(name="player")
 * @ORM\Entity(repositoryClass="Sportnetzwerk\SpnBundle\Entity\PlayerRepository")
 */

class Player implements UserInterface, \Serializable, EncoderAwareInterface{
    
    
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
     * @ORM\Column(type="string", length=45)
     */
    protected $lastname;
    
    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $email;
    
    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $username;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $password;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $birthday;
    
    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $sports;
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity="Gender")
     * @ORM\JoinColumn(name="gender", referencedColumnName="id")
     */
    protected $gender;
    
    /**
     * @ORM\Column(type="string", length=8)
     */
    protected $zipcode;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $activityradius;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $created;
    
    /**
     * @ORM\Column(type="string", length=2)
     */
    protected $popularity;
    
    /**
     * @ORM\Column(type="string", length=2)
     */
    protected $evaluate;
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity="Playerstatus")
     * @ORM\JoinColumn(name="playerstatus", referencedColumnName="id")
     */
    protected $playerstatus;
    
    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $skills;
    
    /**
     * @ORM\Column(type="integer")
     */
    
    protected $registered;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $online;
    
    /**
     * pe stands for player event
     * @ORM\OneToMany(targetEntity="PlayerEvents", mappedBy="player", cascade={"all"}) 
     */
    protected $pe;
    
    /**
     * The players profile image
     * @ORM\Column(type="string", length=100)
     */
    protected $image;
    
    
    public function __construct() {
        
    }
    
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new Assert\NotBlank());
        $metadata->addPropertyConstraint('lastname', new Assert\NotBlank());
        $metadata->addPropertyConstraint('email', new Assert\NotBlank());
        $metadata->addConstraint(new UniqueEntity(
                array(
                    'fields' => 'email',
                    'message' => 'This email/username already exists'
                )
        ));
        $metadata->addPropertyConstraint('email', new Assert\Email(
                array(
                    'message' => 'The email "{{ value }}" is not a valid email.',
                    'checkMX' => true,
                )));
        
        $metadata->addPropertyConstraint('username', new Assert\NotBlank());
        $metadata->addConstraint(new UniqueEntity(
                array(
                    'fields' => 'username',
                    'message' => 'This username already exists'
                )
        ));
        $metadata->addPropertyConstraint('password', new Assert\NotBlank());
        $metadata->addPropertyConstraint('password', new Assert\Regex(
                array(
                    //'pattern' => '[`~,.<>;:"\'/\[\]|{}()=_+-]',
                    'pattern' =>  "/[\$\]\(\)\*\+\.\?\[\\\^\{\|!%&:;'`<>,~#=\"\\/]/",
                    'match'   => false,
                    'message' => 'Your Password cannot contain any of those characters `~,.<>;:"\'/\[\]|{}()=_+-',
                ))
                );
        
        $metadata->addPropertyConstraint('birthday', new Assert\NotBlank());
        $metadata->addPropertyConstraint('sports', new Assert\NotBlank());
        $metadata->addPropertyConstraint('zipcode', new Assert\NotBlank());
        
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
     * @return Player
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
     * Set lastname
     *
     * @param string $lastname
     * @return Player
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Player
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Player
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        //trigger_error('@@@@@@@@@@@@@@@username'.$this->username);
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;//name of property may cause conflict...we'll see...
    }   

     /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }
    
     /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }

    
    /**
     * Set birthday
     *
     * @param integer $birthday
     * @return Player
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return integer 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set sports
     *
     * @param string $sports
     * @return Player
     */
    public function setSports($sports)
    {
        $this->sports = $sports;

        return $this;
    }

    /**
     * Get sports
     *
     * @return string 
     */
    public function getSports()
    {
        return $this->sports;
    }

    /**
     * Set gender
     *
     * @param integer $gender
     * @return Player
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
     * Set zipcode
     *
     * @param string $zipcode
     * @return Player
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string 
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set activityradius
     *
     * @param integer $activityradius
     * @return Player
     */
    public function setActivityradius($activityradius)
    {
        $this->activityradius = $activityradius;

        return $this;
    }

    /**
     * Get activityradius
     *
     * @return integer 
     */
    public function getActivityradius()
    {
        return $this->activityradius;
    }

    /**
     * Set created
     *
     * @param integer $created
     * @return Player
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
     * Set popularity
     *
     * @param string $popularity
     * @return Player
     */
    public function setPopularity($popularity)
    {
        $this->popularity = $popularity;

        return $this;
    }

    /**
     * Get popularity
     *
     * @return string 
     */
    public function getPopularity()
    {
        return $this->popularity;
    }

    /**
     * Set evaluate
     *
     * @param string $evaluate
     * @return Player
     */
    public function setEvaluate($evaluate)
    {
        $this->evaluate = $evaluate;

        return $this;
    }

    /**
     * Get evaluate
     *
     * @return string 
     */
    public function getEvaluate()
    {
        return $this->evaluate;
    }

    /**
     * Set playerstatus
     *
     * @param integer $playerstatus
     * @return Player
     */
    public function setPlayerstatus($playerstatus)
    {
        $this->playerstatus = $playerstatus;

        return $this;
    }

    /**
     * Get playerstatus
     *
     * @return integer 
     */
    public function getPlayerstatus()
    {
        return $this->playerstatus;
    }

    /**
     * Set skills
     *
     * @param string $skills
     * @return Player
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;

        return $this;
    }

    /**
     * Get skills
     *
     * @return string 
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Set registered
     *
     * @param integer $registered
     * @return Player
     */
    public function setRegistered($registered)
    {
        $this->registered = $registered;

        return $this;
    }

    /**
     * Get registered
     *
     * @return integer 
     */
    public function getRegistered()
    {
        return $this->registered;
    }

    /**
     * Set online
     *
     * @param integer $online
     * @return Player
     */
    public function setOnline($online)
    {
        $this->online = $online;

        return $this;
    }

    /**
     * Get online
     *
     * @return integer 
     */
    public function getOnline()
    {
        return $this->online;
    }
    
    
    /**
     * Set password
     *
     * @param string $password
     * @return Player
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
    
    public function getEncoderName() {
        if( $this->getRegistered() > 0){
            return 'hashed';
        }
        return 'pussy';
    }

  

    /**
     * Add pe
     *
     * @param \Sportnetzwerk\SpnBundle\Entity\PlayerEvents $pe
     * @return Player
     */
    public function addPe(\Sportnetzwerk\SpnBundle\Entity\PlayerEvents $pe)
    {
        $this->pe[] = $pe;

        return $this;
    }

    /**
     * Remove pe
     *
     * @param \Sportnetzwerk\SpnBundle\Entity\PlayerEvents $pe
     */
    public function removePe(\Sportnetzwerk\SpnBundle\Entity\PlayerEvents $pe)
    {
        $this->pe->removeElement($pe);
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
     * Set image
     *
     * @param string $image
     *
     * @return Player
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
