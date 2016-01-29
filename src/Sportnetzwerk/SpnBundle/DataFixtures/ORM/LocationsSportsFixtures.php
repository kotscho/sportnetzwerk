<?php

namespace Sportnetzwerk\SpnBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sportnetzwerk\SpnBundle\Entity\LocationsSports;
use Sportnetzwerk\SpnBundle\Entity\Locations;
use Sportnetzwerk\SpnBundle\Entity\Sports;

class LocationsSportsFixtures extends AbstractFixture implements OrderedFixtureInterface{
    
    public function load(ObjectManager $manager) 
    {
        $LocationsSports1 = new LocationsSports();
        $LocationsSports1->setLocationsId($manager->merge($this->getReference('Locations1')));
        $LocationsSports1->setSportsId($manager->merge($this->getReference('Sports1')));
        $manager->persist($LocationsSports1);
        $manager->flush();
        
        $LocationsSports2 = new LocationsSports();
        $LocationsSports2->setLocationsId($manager->merge($this->getReference('Locations2')));
        $LocationsSports2->setSportsId($manager->merge($this->getReference('Sports4')));
        $manager->persist($LocationsSports2);
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 15;
    }
}