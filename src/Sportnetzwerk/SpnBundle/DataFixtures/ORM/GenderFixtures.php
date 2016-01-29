<?php

namespace Sportnetzwerk\SpnBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sportnetzwerk\SpnBundle\Entity\Gender;

class GenderFixtures extends AbstractFixture implements OrderedFixtureInterface{
    
    public function load(ObjectManager $manager) 
    {
        $Gender1 = new Gender();
        $Gender1->setName("Männlich");
        $manager->persist($Gender1);
       
        $Gender2 = new Gender();
        $Gender2->setName("Weiblich");
        $manager->persist($Gender2);
        
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 5;
    }
}