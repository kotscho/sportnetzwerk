<?php

namespace Sportnetzwerk\SpnBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Session\Session;
use Sportnetzwerk\SpnBundle\Entity\PlayerEvents;
use Sportnetzwerk\SpnBundle\Entity\Player;
/**
 * EventsRepository
 *
 */
class EventsRepository extends EntityRepository
{

    
    public function createEvent(\Symfony\Component\Form\Form $form)
    {
        
        $this->created = time();
        $event = new Events();
        
        $event->setSportsId($form->get('sports_id')->getData());
        $event->setLocationsId($form->get('locations_id')->getData());
        $event->setSkillLevelsId($form->get('skill_levels_id')->getData()->getId());
        $event->setGender($form->get('gender')->getData());
        $event->setZipArea($form->get('zip_area')->getData());
        $event->setInitiator($form->get('initiator')->getData());
        /**
         * @deprecated field autoselect
         */
        $event->setAutoselect('on');
        $event->setNumOfPlayers($form->get('num_of_players')->getData());
        $event->setStart(strtotime($form->get('start')->getData()->format('Y-m-d H:i:s')));
        $event->setEnd(strtotime($form->get('end')->getData()->format('Y-m-d H:i:s')));
        $event->setEventStatus(0);//set to true after first invitation
        $notes = $form->get('notes')->getData();
        if (!empty( $notes )){
            $event->setNotes($form->get('notes')->getData());
        }
        $em = $this->getEntityManager();
        $em->persist($event);
        $em->flush();
        
        return $event->getId();
    }
}
