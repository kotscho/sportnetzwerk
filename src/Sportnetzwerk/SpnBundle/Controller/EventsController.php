<?php

namespace Sportnetzwerk\SpnBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;  
use Symfony\Component\HttpFoundation\JsonResponse;
use Sportnetzwerk\SpnBundle\Entity\Events;
use Sportnetzwerk\SpnBundle\Entity\PlayerEvents;
use Sportnetzwerk\SpnBundle\Entity\Player;
use Sportnetzwerk\SpnBundle\Entity\Sports;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\SecurityContextInterface;



class EventsController extends Controller {
    
    public function ajaxStoreEventAction( Request $request )
    {
        if( $request->isXMLHttpRequest() ){
            $em = $this->getDoctrine()->getManager();
            $playerIds = $request->get('player_ids');//actually emails
            $eventId = $request->get('event_id');
            $event = $this->getDoctrine()->getRepository("SportnetzwerkSpnBundle:Events")->findById($eventId);
            $event[0]->setEventStatus(1);//set activation flag
            $created = $event[0]->getCreated();
            foreach ($playerIds as $k => $p){
                $player = $this->getDoctrine()->getRepository("SportnetzwerkSpnBundle:Player")->findByEmail($p);
                $token = md5($eventId.$player[0]->getName().$player[0]->getEmail().$created);
                $playerEvent = new PlayerEvents();
                $playerEvent->setEvent($event[0]);
                $playerEvent->setPlayer($player[0]);
                $playerEvent->setToken($token);
                $em->persist($playerEvent);
                $em->flush();
                $token = $this->getDoctrine()->getRepository("SportnetzwerkSpnBundle:PlayerEvents")
                                ->getEventToken($player[0], $eventId);
                $message = \Swift_Message::newInstance()
                ->setSubject('Event invitation - Sportnetzwerk')
                ->setFrom('koko.developer@gmail.com')//which is actually the system mail from config
                ->setTo($player[0]->getEmail())
                ->setBody($this->render('SportnetzwerkSpnBundle:Events:eventInvitationEmail.txt.twig', array('player' => $player[0], 'token' => $token, 'newschedule' => true )));
                $this->get('mailer')->send($message);
            }
            return new JsonResponse(true);
        }
        return new Response('No ajax here', 400);
    }
    
    
    public function processTokenLinkAction($token, $id, Request $request){
        $token = $this->getDoctrine()
                ->getRepository("SportnetzwerkSpnBundle:PlayerEvents")
                ->findByToken($token);
        $player = $this->getDoctrine()->getRepository('SportnetzwerkSpnBundle:Player')
                  ->findById($id);
        if( !empty($token) ){
            $error = false;
            if($token[0]->getAccepted() === 1){//event has already been confirmed
                $error = true;
                return $this->redirect($this->generateUrl('sportnetzwerk_spn_invitation_mail_confirmed', array('error' => $error)));
            }
            //set accepted flag
            $em = $this->getDoctrine()->getManager();
            $token[0]->setAccepted(1);
            $em->persist($token[0]);
            $em->flush();
            //login on success
            $userPasswordToken =new UsernamePasswordToken(
                $player[0],
                $player[0]->getPassword(),
                'secured_area',
                $player[0]->getRoles()
                );
            $this->get('security.context')->setToken($userPasswordToken);
            $request->getSession()->set('_security_secured_area', serialize($userPasswordToken));
            return $this->redirect($this->generateUrl('sportnetzwerk_spn_invitation_mail_confirmed', array('error' => $error)));
        }
        else{
            $error = true;     
            return $this->redirect($this->generateUrl('sportnetzwerk_spn_invitation_mail_confirmed', array('error' => $error)));
        }
    }
    
    public function eventInvitationConfirmedAction(Request $request){
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Sportnetzwerk", $this->get("router")->generate("sportnetzwerk_spn_homepage"));
        
        if($request->get('error') == false){
            $breadcrumbs->addItem("Einladung bestätigt");
            return $this->render('SportnetzwerkSpnBundle:Events:eventInvitationConfirmed.html.twig');
        }
        else{
            $breadcrumbs->addItem("Fehler aufgetreten");
            return $this->render('SportnetzwerkSpnBundle:Events:eventInvitationError.html.twig');
        }
    }
    
    public function scheduleAction(Request $request){

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Sportnetzwerk", $this->get("router")->generate("sportnetzwerk_spn_homepage"));
        $breadcrumbs->addItem("Spielplan");
        $events = $this->getDoctrine()
                ->getRepository("SportnetzwerkSpnBundle:PlayerEvents")
                ->getPlayerEvents($this->getUser());
        foreach($events as $plEvent){
            $event = $this->getDoctrine()
                           ->getRepository("SportnetzwerkSpnBundle:Events")
                           ->findOneById($plEvent->getEvent()->getId());
            $sports = $this->getDoctrine()
                     ->getRepository("SportnetzwerkSpnBundle:Sports")
                     ->findOneById($event->getSportsId());
            $playerCount = $this->getDoctrine()
                     ->getRepository("SportnetzwerkSpnBundle:PlayerEvents")
                     ->getEventPlayers($event->getId());
            $playerNames = $this->getDoctrine()
                            ->getRepository("SportnetzwerkSpnBundle:PlayerEvents")
                            ->getEventPlayersNames($event->getId());
            $eventData[] = array('id' =>  $event->getId(),
                                 'sportsname' => $sports->getName(),
                                 'num_of_players' => $playerCount,
                                 'player_names' => $playerNames,
                                 'current_user' => $this->getUser()->getId(),
                                 'initiator' => $event->getInitiator(),
                                 'start' => date('c', $event->getStart()),//new Date(y, m, d, 10, 30)
                                 'end' => date('c', $event->getEnd()),
                           );
        }
        
        return $this->render("SportnetzwerkSpnBundle:Events:eventSchedule.html.twig", array('events' => $eventData));
    }
    
    public function ajaxReinvitationEventAction(Request $request){
        if( $request->isXmlHttpRequest() ){
            
            //Request values: eventId, newEventDateStart, newEventDateEnd
            $event = $this->getDoctrine()
                           ->getRepository("SportnetzwerkSpnBundle:Events")
                           ->findOneById($request->get('eventId'));
            //update event
            $event->setStart(strtotime($request->get('newStart')));
            $event->setEnd(strtotime($request->get('newEnd')));
            $created = $event->getCreated();
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            //inform all participating players
            $plEvents = $this->getDoctrine()
                           ->getRepository("SportnetzwerkSpnBundle:PlayerEvents")
                           ->findByEvent($event);
            foreach( $plEvents as $plEvent ){
                $player = $plEvent->getPlayer();
                $mail = $plEvent->getPlayer()->getEmail();
                $name = $plEvent->getPlayer()->getName();
                //generate and set new token
                $token = md5($request->get('eventId').$name.$mail.$created);
                $plEvent->setToken($token);
                $plEvent->setAccepted(0);
                $em->persist($plEvent);
                $em->flush();
                //send the mail
                $token = $this->getDoctrine()->getRepository("SportnetzwerkSpnBundle:PlayerEvents")
                                ->getEventToken($player, $event->getId());
                $message = \Swift_Message::newInstance()
                ->setSubject('Event rescheduled - Sportnetzwerk')
                ->setFrom('koko.developer@gmail.com')
                ->setTo($mail)
                ->setBody($this->renderView('SportnetzwerkSpnBundle:Events:eventInvitationEmail.txt.twig', array('player' => $player, 'token' => $token, 'newschedule' => false)));
                $this->get('mailer')->send($message); 
            }
            //trigger_error(var_export($mails, true));//DONE
            return new JsonResponse(true);
        }
        return new Response('No ajax here', 400);
    }
    
    public function scheduleDetailsAction(){}
    /**
     * Send event related offers (from Energybars to Tennis shoes to Balls etc.) 
     * within the timeslot given between Event confirmation and event start, using 
     * a cron job f.e
     * Find and motivate some Business-Partners...
     */
    public function sendSportsgearRelatedOffers(){}
    
}