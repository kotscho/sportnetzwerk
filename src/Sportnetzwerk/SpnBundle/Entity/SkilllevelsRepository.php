<?php

namespace Sportnetzwerk\SpnBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SportsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SkilllevelsRepository extends EntityRepository
{

    public function getSkills()
    { 
        
        $res = $this->findAll();
        //trigger_error(var_export($res, true));
        foreach( $res as $k => $v )
        {          
            $skills[] = array( 'name' => $v->getName(),
                               'id' =>  $v->getId()
                    );
        }
        return $skills;
    }
}
