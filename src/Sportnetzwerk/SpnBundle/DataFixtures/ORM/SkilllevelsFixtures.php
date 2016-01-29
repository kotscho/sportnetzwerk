<?php

namespace Sportnetzwerk\SpnBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sportnetzwerk\SpnBundle\Entity\Skilllevels;

class SkilllevelsFixtures extends AbstractFixture implements OrderedFixtureInterface{
    
    public function load(ObjectManager $manager) 
    {
        $Skilllevels1 = new Skilllevels();
        $Skilllevels1->setName("pro");
        $manager->persist($Skilllevels1);
       
        $Skilllevels2 = new Skilllevels();
        $Skilllevels2->setName("ambitioniert");
        $manager->persist($Skilllevels2);
        
        $Skilllevels3 = new Skilllevels();
        $Skilllevels3->setName("hobby");
        $manager->persist($Skilllevels3);
        
        $manager->flush();
        $this->addReference('Skilllevels1', $Skilllevels1);
        $this->addReference('Skilllevels2', $Skilllevels2);
    }
 
    public function getOrder()
    {
        return 2;
    }
}