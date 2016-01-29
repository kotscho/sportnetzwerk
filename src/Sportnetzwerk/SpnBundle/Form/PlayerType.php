<?php

namespace Sportnetzwerk\SpnBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PlayerType extends AbstractType
{
    /**
     *
     * @todo rename this class to PlayerType and map it to Player entity 
     */
    private $doctrine;
    
    public function __construct(RegistryInterface $doctrine) {
        $this->doctrine = $doctrine;
    }   
    
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('name');
        $builder->add('lastname');
        $builder->add('email');
        $builder->add('gender', 'entity', array('class'=>'SportnetzwerkSpnBundle:Gender',
            'multiple' => false, 'expanded' => false, 'property'=>'name'));
        //$builder->add('passwd', 'password');
        //$builder->add('passwdrepeat', 'password');
        $builder->add('username');
        $builder->add('password', 'repeated', array(
        'type' => 'password',
        'invalid_message' => 'The password fields must match.',
        'options' => array('attr' => array('class' => 'password-field')),
        'required' => true,
        ));
        $builder->add('birthday','date', array('widget' => 'single_text', 
                                        'format' => 'dd-MM-yy',
                                         'attr' => array('class' => 'date')
                                        )
                );
        $builder->add('zipcode');
        
        /**
         * This one loads options from a Doctrine entity
         * @todo kdos: populate tables sports and sports_categories
         * 
         */
        $arr = $this->getAllSportsCategories();
        //trigger_error( var_export($arr, true) );
        $builder->add('sports', 'choice', array( //'class' => 'SportnetzwerkSpnBundle:Sportscategories', 
                                                 'multiple' => true,
                                                 'expanded' => false,
                                                //'property' => 'name',
                                                'choices' => $arr
                                                ));
        $builder->add('player_status', 'entity', array('class'=>'SportnetzwerkSpnBundle:Playerstatus',
            'multiple' => false, 'expanded' => false, 'property'=>'name'));
        
        $builder->add('evaluate', 'choice', array('choices' => array( '0' => 'deaktiviert', '1' => 'aktiviert' )));
       
        $builder->add('activityradius', 'choice', array('choices' => array( 5 => 5, 10 => 10, 15 => 15 )));
        
        /**
         * @deprecated Activity Places
         * @todo image, popularity, selected sports
         */
        
    }
    
    public function getName() 
    {
        return 'player_signup';
    }
    
    private function getAllSportsCategories()
    {
        return $this->doctrine->getRepository("SportnetzwerkSpnBundle:Sportscategories")
                ->getCategoryTree();
    }
}

