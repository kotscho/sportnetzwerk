<?php

namespace Sportnetzwerk\SpnBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SportscategoriesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SportscategoriesRepository extends EntityRepository
{
    
    
    public function getCategoryTree()
    {
        $em = $this->getEntityManager();
        
        $res = $em->createQuery("SELECT sc.name, sc.id as cat from "
                        . "SportnetzwerkSpnBundle:Sportscategories sc order by cat"
                        )
                ->getResult();
        foreach( $res as $k => $v )
        {
            $current = $this->find($v['cat']);
            $sports = $current->getSports();
            foreach($sports as $sport)
            {
                $relatedSports[$sport->getId()] =  $sport->getName();//danger - this hurts!..calm t.f.d.
            }
            $cats[$v['name']] = $relatedSports;
            unset($relatedSports);
        }
        
        //trigger_error(var_export($cats, true));
        return $cats;
                
    }
}