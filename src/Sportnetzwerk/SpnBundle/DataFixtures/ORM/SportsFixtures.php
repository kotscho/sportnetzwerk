<?php

namespace Sportnetzwerk\SpnBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sportnetzwerk\SpnBundle\Entity\Sports;
use Sportnetzwerk\SpnBundle\Entity\Sportscategories;

class SportsFixtures extends AbstractFixture implements OrderedFixtureInterface{
    
    public function load(ObjectManager $manager) 
    {
        $Sports1 = new Sports();
        $Sports1->setName("Fussball");
        $Sports1->setSportsCategory($manager->merge($this->getReference('SpnCateg1')));
        $Sports1->setCreated(time());
        $manager->persist($Sports1);
       
        $Sports2 = new Sports();
        $Sports2->setName("Handball");
        $Sports2->setSportsCategory($manager->merge($this->getReference('SpnCateg1')));
        $Sports2->setCreated(time());
        $manager->persist($Sports2);
        
        $Sports3 = new Sports();
        $Sports3->setName("Mountainbikeing");
        $Sports3->setSportsCategory($manager->merge($this->getReference('SpnCateg2')));
        $Sports3->setCreated(time());
        $manager->persist($Sports3);
        
        $Sports4 = new Sports();
        $Sports4->setName("Tennis");
        $Sports4->setSportsCategory($manager->merge($this->getReference('SpnCateg3')));
        $Sports4->setCreated(time());
        $manager->persist($Sports4);
        
        $Sports5 = new Sports();
        $Sports5->setName("Badminton");
        $Sports5->setSportsCategory($manager->merge($this->getReference('SpnCateg3')));
        $Sports5->setCreated(time());
        $manager->persist($Sports5);
        
        $Sports6 = new Sports();
        $Sports6->setName("Judo");
        $Sports6->setSportsCategory($manager->merge($this->getReference('SpnCateg4')));
        $Sports6->setCreated(time());
        $manager->persist($Sports6);
        
        $Sports7 = new Sports();
        $Sports7->setName("Marathon");
        $Sports7->setSportsCategory($manager->merge($this->getReference('SpnCateg5')));
        $Sports7->setCreated(time());
        $manager->persist($Sports7);
        
        $Sports8 = new Sports();
        $Sports8->setName("Aquagymnastik");
        $Sports8->setSportsCategory($manager->merge($this->getReference('SpnCateg6')));
        $Sports8->setCreated(time());
        $manager->persist($Sports8);
        
        $Sports9 = new Sports();
        $Sports9->setName("Beachtennis");
        $Sports9->setSportsCategory($manager->merge($this->getReference('SpnCateg7')));
        $Sports9->setCreated(time());
        $manager->persist($Sports9);
        
        $Sports10 = new Sports();
        $Sports10->setName("Beachtvolley");
        $Sports10->setSportsCategory($manager->merge($this->getReference('SpnCateg7')));
        $Sports10->setCreated(time());
        $manager->persist($Sports10);
        
        $Sports11 = new Sports();
        $Sports11->setName("Boxing");
        $Sports11->setSportsCategory($manager->merge($this->getReference('SpnCateg4')));
        $Sports11->setCreated(time());
        $manager->persist($Sports11);
        
        $manager->flush();
        $this->addReference('Sports1', $Sports1);
        $this->addReference('Sports4', $Sports4);
    }
    
    public function getOrder()
    {
        return 7;
    }
}