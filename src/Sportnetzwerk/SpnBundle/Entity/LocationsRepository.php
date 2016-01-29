<?php

namespace Sportnetzwerk\SpnBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * LocationsRepository
 *
 */
class LocationsRepository extends EntityRepository
{

    public function getLocations( $zipCode, $sportsId = null)
    { 
        $locationsByZip = array();
        $locationsByZipAndSportsId = array();
        $locations = $this->findByZip($zipCode);
        foreach ( $locations as $k => $v ){
            //check how this array should look like in order to get rendered properly
            $locationsByZip[$locations[$k]->getId()] = $locations[$k]->getName();
        }
        if( is_null($sportsId) ) {
            return $locationsByZip; 
        }

        foreach ( $locationsByZip as $k => $v){
            $lsObj = $this->getEntityManager()->getRepository("SportnetzwerkSpnBundle:LocationsSports")->findByLocationsId($k);
            //trigger_error(var_export($lsObj[0]->getSportsId()->getId(), true));
            if ($lsObj[0]->getSportsId()->getId() == $sportsId){
                $locationsByZipAndSportsId[$k] = $v;
            }
            unset($lsObj);
           
        }
        return $locationsByZipAndSportsId;
    }
}
