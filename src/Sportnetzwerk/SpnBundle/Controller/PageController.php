<?php
// src/Sportnetzwerk/SpnBundle/Controller/PageController.php

namespace Sportnetzwerk\SpnBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sportnetzwerk\SpnBundle\Entity\Player;
use Sportnetzwerk\SpnBundle\Form\PlayerType;
use Sportnetzwerk\SpnBundle\Entity\Events;
use Sportnetzwerk\SpnBundle\Form\EventType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;  
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Form;


class PageController extends Controller
{

    public function indexAction()
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Sportnetzwerk", $this->get("router")->generate("sportnetzwerk_spn_homepage"));
        $breadcrumbs->addItem("Home");
        $player = new Player();
        $form = $this->createForm(new PlayerType($this->getDoctrine()), $player);
        $request = $this->getRequest();
        $validationErrors = array();
        if( $request->getMethod() == 'POST' )
        {
            $form->bind($request);
            if($form->isValid())
            {
                $this->getDoctrine()->getRepository('SportnetzwerkSpnBundle:Player')->insertPlayerData($form);
                $token = $this->getDoctrine()->getRepository('SportnetzwerkSpnBundle:Player')->generatePlayerToken($form);
                $newPlayer = $this->getDoctrine()->getRepository('SportnetzwerkSpnBundle:Player')->findByEmail($player->getEmail());
                /**
                 * @todo put the following mailer logic into seperate (repository) method
                 */
                $message = \Swift_Message::newInstance()
                ->setSubject('Willkommen - Aktivierungslink Sportnetzwerk')
                ->setFrom('koko.developer@gmail.com')
                ->setTo($player->getEmail())
                ->setBody($this->renderView('SportnetzwerkSpnBundle:Page:signupConfirmationEmail.txt.twig', array('player' => $player, 'id' => $newPlayer[0]->getId(), 'token' => $token)));
                $this->get('mailer')->send($message);
                
                return $this->redirect($this->generateUrl('sportnetzwerk_spn_signup2'));
            }
            else
            {
                foreach( $form->all() as $child )
                {
                    if(!$child->isValid()){
                        $validationErrors[$form->getName().'_'.$child->getName()] = substr($child->getErrorsAsString(), 7);
                    }
                }
                //cleanup strings - just in case
                foreach( $validationErrors as $k => $v )
                {
                    $name = explode('_', $k);
                    if(stristr( $v, 'error' ))
                    {
                        $validationErrors[$k] = end($name).': '.substr($v, 10);
                    }
                    else
                    {
                        $validationErrors[$k] = end($name).': '.$v;
                    }
                }
            }
        }
        return $this->render('SportnetzwerkSpnBundle:Page:index.html.twig', array(
                'form' => $form->createView(), 'validationmsg' => $validationErrors ));
    }
    
    public function signup2Action()
    {
        return $this->render('SportnetzwerkSpnBundle:Page:signup2.html.twig');
    }
    
    public function setskillsAction()
    {
        //Set skills in config
        /**
         * @todo change this routine - get data from previously inserted player data
         */
        $cats = array();
        if(!empty($_POST['player_signup']['sports']))
        {
            foreach( $_POST['player_signup']['sports'] as $v)
            {
                $cats[]=$v;
            }
        }
        $sports = $this->getDoctrine()->getRepository("SportnetzwerkSpnBundle:Sports")
                  ->getSportsCategories($cats);
        $skills = $this->getDoctrine()->getRepository("SportnetzwerkSpnBundle:Skilllevels")
                  ->getSkills();
        
        return $this->render('SportnetzwerkSpnBundle:Page:setskills.html.twig', array('sportslist'=> $sports, 
                                                                                    'skilllist' => $skills));
    }
    
    public function faqAction()
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Sportnetzwerk", $this->get("router")->generate("sportnetzwerk_spn_homepage"));
        $breadcrumbs->addItem("FAQs");
        return $this->render('SportnetzwerkSpnBundle:Page:faq.html.twig');
    }
    
    public function contactAction()
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Sportnetzwerk", $this->get("router")->generate("sportnetzwerk_spn_homepage"));
        $breadcrumbs->addItem("Contact");
        return $this->render('SportnetzwerkSpnBundle:Page:contact.html.twig');
    }
    
    public function findAction()
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Sportnetzwerk", $this->get("router")->generate("sportnetzwerk_spn_homepage"));
        $breadcrumbs->addItem("Spielersuche", $this->get("router")->generate("sportnetzwerk_spn_findPlayer"));
        $validationErrors = array();
        $events = new Events();
        $form = $this->createForm(new EventType($this->getDoctrine(), $this->getUser()), $events);
        $request = $this->getRequest();
        if( $request->getMethod() == 'POST' ){
            //do what it takes 
            $form->bind($request);
            if ( $form->isValid() ){
                //store event with status inactive
                $eventId =$this->getDoctrine()->getRepository('SportnetzwerkSpnBundle:Events')->createEvent($form);
                //
                //pass data for result rendering
                $params['startDate'] = strtotime($form->get('start')->getData()->format('Y-m-d H:i:s'));
                $params['endDate'] = strtotime($form->get('end')->getData()->format('Y-m-d H:i:s'));
                $params['sportsId'] = $form->get('sports_id')->getData();
                $params['zip'] =  $form->get('zip_area')->getData();
                $params['location'] =  $form->get('locations_id')->getData();
                $params['gender'] = $form->get('gender')->getData();
                $params['skillLevelsId'] =  $form->get('skill_levels_id')->getData()->getId();
                $params['numOfPlayers'] = $form->get('num_of_players')->getData();
                $params['eventId'] = $eventId;
                
                return $this->redirect($this->generateUrl('sportnetzwerk_spn_findPlayerResults', $params));
            } else {
                    foreach( $form->all() as $child ) {
                        if(!$child->isValid()) {
                            $validationErrors[$form->getName().'_'.$child->getName()] = substr($child->getErrorsAsString(), 7);
                        }
                    }
                    foreach( $validationErrors as $k => $v ) {
                        $name = explode('_', $k);                       
                        if(stristr( $v, 'error' )) {
                            $validationErrors[$k] = end($name).': '.substr($v, 10);
                        } else {
                            $validationErrors[$k] = end($name).': '.$v;
                        }
                    }
              }
        }

        return $this->render('SportnetzwerkSpnBundle:Page:findPlayer.html.twig',
                array('form' => $form->createView(), 'validationmsg' => $validationErrors));
        
    }
    
    public function ajaxLocationsAction( Request $request)
    {
        if( $request->isXMLHttpRequest() ){
            $locations = $this->getDoctrine()->getRepository("SportnetzwerkSpnBundle:Locations")
                           ->getLocations($request->get('zip'), $request->get('sportsId'));
                   //trigger_error(var_export($locations, true));
            return new JsonResponse($locations);
        }
        return new Response('No ajax here', 400);
    }
    
    public function showPlayersAction(Request $request)
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Sportnetwerk", $this->get("router")->generate("sportnetzwerk_spn_homepage"));
        $breadcrumbs->addItem("Spielersuche", $this->get("router")->generate("sportnetzwerk_spn_findPlayer"));
        $breadcrumbs->addItem("Ergebnisse");

        $players = $this->getDoctrine()->getRepository("SportnetzwerkSpnBundle:Player")
                  ->getPlayersCandidates($request->get('zip'), 
                          $request->get('numOfPlayers'), 
                          $request->get('sportsId'),
                          $request->get('skillLevelsId'),
                          $request->get('startDate'),
                          $request->get('endDate')
                          );
        /**
       * @todo store players event cross reference entries
       */
        return $this->render('SportnetzwerkSpnBundle:Page:showPlayers.html.twig', array( 'players' => $players, 'eventId' => $request->get('eventId') ));
    }
    
    
    public function invitationDoneAction()
    {
        return $this->render('SportnetzwerkSpnBundle:Page:invitationDone.html.twig');
    }
}