<?php

namespace Sportnetzwerk\SpnBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sportnetzwerk\SpnBundle\Entity\Player;

class PlayerFixture extends AbstractFixture implements OrderedFixtureInterface{
    
    public function load(ObjectManager $manager) 
    {
        $Player1 = new Player();
        $Player1->setName('Koko');
        $Player1->setLastname('Mueller');
        $Player1->setEmail('koko.developer@gmail.com');
        $Player1->setUsername('koko.developer@gmail.com');
        $Player1->setPassword(md5('koko'));
        $Player1->setBirthday(time());
        $Player1->setSports('1:2:4');
        $Player1->setGender(1);
        $Player1->setActivityradius(10);
        $Player1->setCreated(time());
        $Player1->setPopularity('bu');
        $Player1->setZipcode("56667");
        $Player1->setEvaluate('1');
        $Player1->setPlayerstatus(1);
        $Player1->setSkills('1:1:2');
        $Player1->setRegistered(1);
        $Player1->setOnline(0);
        
        $manager->persist($Player1);
        
        $manager->flush();
        $this->addReference('Player1', $Player1);
    }
    
    public function getOrder()
    {
        return 9;
    }
}