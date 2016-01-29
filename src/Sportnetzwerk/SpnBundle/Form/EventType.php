<?php

namespace Sportnetzwerk\SpnBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Sportnetzwerk\SpnBundle\Entity\Player;

class EventType extends AbstractType
{
    
    public function  __construct(RegistryInterface $doctrine, Player $player){
        $this->player = $player;
        $this->doctrine = $doctrine; 
    }
    
    public function getName(){
        return 'event_form';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $arr = $this->getPlayerRelatedSports();
        //Default zipcode is the player location
        $playerZip = $this->player->getZipcode();
        $builder->add('sports_id', 'choice', array( 'multiple' => false,
                                                 'expanded' => false,
                                                 'choices' => $arr
                                                ));
        
        $builder->add('locations_id', 'choice', array('choices'=> $this->getLocationSports($playerZip),
            'multiple' => false, 'expanded' => false ));
        
        $builder->add('start','datetime', array('widget' => 'single_text', 
                                        //'format' => 'dd-MM-yy HH:ii',
                                          //'attr' => array('class' => 'datetime')
                                        ));
        $builder->add('end','datetime', array('widget' => 'single_text', 
                                        //'format' => 'dd-MM-yy HH:ii', //'attr' => array('class' => 'datetime')
                                          //'attr' => array('class' => 'datetime')
                                        ));
        
        $builder->add('skill_levels_id', 'entity', array('class' => 'SportnetzwerkSpnBundle:Skilllevels',
            'multiple' => false, 'expanded' => false, 'property' =>'name' ));
        
         $builder->add('gender', 'choice', array('choices'=> $this->getGender(),
            'multiple' => false, 'expanded' => false, ));
        
        
        $builder->add('num_of_players');
        
        $builder->add('zip_area');
        
        $builder->add('notes', 'textarea', array());
        
        $builder->add('initiator', 'hidden', array('data' => $this->player->getId()));
    }
    //called once upon first page load
    private function getLocationSports($zip, $sportsId=null)
    {
        /**
         * this is a totally unforseen fix: 
         * Selected (ajax)value must be part of a rerference array in order to pass 
         * symfonies internal validation
         */
        $locations = $this->doctrine->getRepository("SportnetzwerkSpnBundle:Locations")->findAll();
        foreach( $locations as $location ){
            $default[$location->getId()] = $location->getName();
        }
        //end of fix
        $array =  $this->doctrine->getRepository("SportnetzwerkSpnBundle:Locations")
                ->getLocations($zip);

        return( !empty($array) ? $array : $default );
    }
    
    private function getAllSportsCategories()
    {
        return $this->doctrine->getRepository("SportnetzwerkSpnBundle:Sportscategories")
                ->getCategoryTree();
    }
    
    private function getPlayerRelatedSports()
    {
        $email = $this->player->getEmail();
        //trigger_error(var_export($email));
        $sports = explode(':', $this->player->getSports());
        //trigger_error(var_export($sports));     
        foreach( $sports as $k => $v ){
            $sport = $this->doctrine->getRepository("SportnetzwerkSpnBundle:Sports")
                           ->find($v);
            //trigger_error(var_export($sport));        
            $sportNames[$v] = $sport->getName();
            //unset($sport);
            
        }
        return $sportNames;
    }
    
    private function getGender()
    {
        return $this->doctrine->getRepository("SportnetzwerkSpnBundle:Gender")->buildGenderArrray();
    }
    
    
}