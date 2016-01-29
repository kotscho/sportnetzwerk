<?php

namespace Sportnetzwerk\SpnBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sportnetzwerk\SpnBundle\Entity\PlayerSportsSkills;
use Sportnetzwerk\SpnBundle\Entity\Skilllevels;
use Sportnetzwerk\SpnBundle\Entity\Sports;
use Sportnetzwerk\SpnBundle\Entity\Player;


class PlayerSportsSkillsFixtures extends AbstractFixture implements OrderedFixtureInterface{
    
    public function load(ObjectManager $manager) 
    {
        $PlayerSportsSkills1 = new PlayerSportsSkills();
        $PlayerSportsSkills1->setSkilllevelsId($manager->merge($this->getReference('Skilllevels1')));
        $PlayerSportsSkills1->setSportsId($manager->merge($this->getReference('Sports1')));
        $PlayerSportsSkills1->setPlayerId($manager->merge($this->getReference('Player1')));
        $manager->persist($PlayerSportsSkills1);
        $manager->flush();
        
        $PlayerSportsSkills2 = new PlayerSportsSkills();
        $PlayerSportsSkills2->setSkilllevelsId($manager->merge($this->getReference('Skilllevels2')));
        $PlayerSportsSkills2->setSportsId($manager->merge($this->getReference('Sports4')));
        $PlayerSportsSkills2->setPlayerId($manager->merge($this->getReference('Player1')));
        $manager->persist($PlayerSportsSkills2);
        $manager->flush();
    }
    
    public function getOrder()
    {
        return 22;
    }
}