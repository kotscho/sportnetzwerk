<?php

namespace Sportnetzwerk\SpnBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sportnetzwerk\SpnBundle\Entity\Events;

class EventsFixtures extends AbstractFixture implements OrderedFixtureInterface{
    
    public function load(ObjectManager $manager) 
    {
        $Events1 = new Events();
        $Events1->setSportsId(1);
        $Events1->setAutoselect("on");
        $Events1->setEnd(time()+7200);
        $Events1->setEventStatus(1);
        $Events1->setGender(1);
        $Events1->setLocationsId(2);
        $Events1->setNumOfPlayers(3);
        $Events1->setStart(time());
        $Events1->setZipArea("47799");
        $Events1->setSkillLevelsId(1);

        $manager->persist($Events1);
        
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 14;
    }
}