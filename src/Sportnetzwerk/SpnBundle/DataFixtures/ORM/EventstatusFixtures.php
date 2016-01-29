<?php

namespace Sportnetzwerk\SpnBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sportnetzwerk\SpnBundle\Entity\Eventstatus;

class EventstatusFixtures extends AbstractFixture implements OrderedFixtureInterface{
    
    public function load(ObjectManager $manager) 
    {
        $Eventstatus1 = new Eventstatus();
        $Eventstatus1->setName("active");
        $manager->persist($Eventstatus1);
       
        $Eventstatus2 = new Eventstatus();
        $Eventstatus2->setName("finnished");
        $manager->persist($Eventstatus2);
        
        $Eventstatus3 = new Eventstatus();
        $Eventstatus3->setName("idle");
        $manager->persist($Eventstatus3);
        
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 6;
    }
}