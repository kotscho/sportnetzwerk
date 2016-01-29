<?php

namespace Sportnetzwerk\SpnBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * GenderRepository
 *
 */
class GenderRepository extends EntityRepository
{

    public function buildGenderArrray()
    { 
      $genders = $this->findAll();
      foreach( $genders as $gender ){
          $array[$gender->getId()] = $gender->getName();
      }
      $array[0] = 'whatever';//key "zero" for no specific gender
      return $array;
    }
}
