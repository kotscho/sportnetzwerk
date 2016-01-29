<?php

namespace Sportnetzwerk\SpnBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sportnetzwerk\SpnBundle\Entity\Locations;
use Sportnetzwerk\SpnBundle\Entity\Sports;

class LocationsFixtures extends AbstractFixture implements OrderedFixtureInterface{
    
    public function load(ObjectManager $manager) 
    {
        $Locations1 = new Locations();
        $Locations1->setName("Bolzplatz");
        $Locations1->setAddress('Street 1');
        $Locations1->setZip('47799');
        $Locations1->setCreated(time());
        $manager->persist($Locations1);
       
        $Locations2 = new Locations();
        $Locations2->setName("Tenniscourt");
        $Locations2->setAddress('Whatever avanue');
        $Locations2->setZip('56667');
        $Locations2->setCreated(time());
        $manager->persist($Locations2);
        
        $manager->flush();
        $this->addReference('Locations1', $Locations1);
        $this->addReference('Locations2', $Locations2);
    }
    
    public function getOrder()
    {
        return 13;
    }
}