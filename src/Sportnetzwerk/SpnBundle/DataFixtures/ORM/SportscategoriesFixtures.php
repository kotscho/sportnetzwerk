<?php

namespace Sportnetzwerk\SpnBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sportnetzwerk\SpnBundle\Entity\Sportscategories;


class SportscategoriesFixtures extends AbstractFixture implements OrderedFixtureInterface{
    
    public function load(ObjectManager $manager) 
    {
        $SpnCateg1 = new Sportscategories();
        $SpnCateg1->setName("Ballsportarten");
        $manager->persist($SpnCateg1);
       
        $SpnCateg2 = new Sportscategories();
        $SpnCateg2->setName("Radsport");
        $manager->persist($SpnCateg2);
        
        $SpnCateg3 = new Sportscategories();
        $SpnCateg3->setName("Racketsports");
        $manager->persist($SpnCateg3);
        
        $SpnCateg4 = new Sportscategories();
        $SpnCateg4->setName("Fightsport");
        $manager->persist($SpnCateg4);
        
        $SpnCateg5 = new Sportscategories();
        $SpnCateg5->setName("Running");
        $manager->persist($SpnCateg5);
        
        $SpnCateg6 = new Sportscategories();
        $SpnCateg6->setName("Schwimmsport");
        $manager->persist($SpnCateg6);
        
        $SpnCateg7 = new Sportscategories();
        $SpnCateg7->setName("Beach/Sandsports");
        $manager->persist($SpnCateg7);
        
        $manager->flush();
        
        $this->addReference('SpnCateg1', $SpnCateg1);
        $this->addReference('SpnCateg2', $SpnCateg2);
        $this->addReference('SpnCateg3', $SpnCateg3);
        $this->addReference('SpnCateg4', $SpnCateg4);
        $this->addReference('SpnCateg5', $SpnCateg5);
        $this->addReference('SpnCateg6', $SpnCateg6);
        $this->addReference('SpnCateg7', $SpnCateg7);
        //ect.
    }
    
    public function getOrder(){
        return 1;
    }
}