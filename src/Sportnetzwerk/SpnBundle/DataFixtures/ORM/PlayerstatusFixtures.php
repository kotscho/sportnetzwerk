<?php

namespace Sportnetzwerk\SpnBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sportnetzwerk\SpnBundle\Entity\Playerstatus;

class PlayerstatusFixtures extends AbstractFixture implements OrderedFixtureInterface{
    
    public function load(ObjectManager $manager) 
    {
        $Playerstatus1 = new Playerstatus();
        $Playerstatus1->setName("spieltrieb");
        $manager->persist($Playerstatus1);
       
        $Playerstatus2 = new Playerstatus();
        $Playerstatus2->setName("offline");
        $manager->persist($Playerstatus2);
        
        $Playerstatus3 = new Playerstatus();
        $Playerstatus3->setName("unsicher");
        $manager->persist($Playerstatus3);
        
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 3;
    }
}