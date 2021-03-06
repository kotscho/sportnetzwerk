<?php

namespace Sportnetzwerk\SpnBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SportsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SportsRepository extends EntityRepository
{

    public function getSportsCategories(array $array)
    { 
        
        foreach( $array as $k => $v )
        {          
            $sports[] = array( 'name' => $this->find($v)->getName(),
                               'id' =>  $this->find($v)->getId()
                    );
        }
        return $sports;
    }
}
