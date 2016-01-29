<?php

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
use Symfony\Component\Security\Core\SecurityContextInterface;

class ProfileController extends Controller{
    
    public function displayAction(){
        $request = $this->getRequest();
        $session = $request->getSession();
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Sportnetzwerk", $this->get("router")->generate("sportnetzwerk_spn_profile_current"));
        $breadcrumbs->addItem("My Settings");
        
        $player = $this->getDoctrine()
                ->getRepository("SportnetzwerkSpnBundle:Player")
                ->findByEmail($this->getUser()->getUsername());
        $form = $this->createForm(new PlayerType($this->getDoctrine()), $player);
        
        //trigger_error(var_export($player, true));
        
        $validationErrors = array();
        if( $request->getMethod() == 'POST' ){
             $form->bind($request);
             if( $form->isValid() ){
                 //return $this->render('SportnetzwerkSpnBundle:Profile:currentProfile.html.twig');
                  return $this->render('SportnetzwerkSpnBundle:Profile:currentProfile.html.twig',
                    array(
                        'form' => $form->createView(), 'validationmsg' => $validationErrors )
                    );
             }
             else {
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
                return $this->render('SportnetzwerkSpnBundle:Profile:currentProfile.html.twig',
                    array(
                        'form' => $form->createView(), 'validationmsg' => $validationErrors )
                    );
            }
        }
        return $this->render('SportnetzwerkSpnBundle:Profile:currentProfile.html.twig',
                    array(
                        'form' => $form->createView(), 'validationmsg' => $validationErrors )
                    );
        
    }
    
    
    public function ajaxStorePasswordAction( Request $request ){
        if( $request->isXmlHttpRequest() ){
            //print 'Old Password is: '.$request->get('oldPassword');
            return new JsonResponse(true);
        }
        return new Response('No ajax here', 400);
    }
    
    
    public function ajaxUploadImageAction( Request $request ){
         if( $request->isXmlHttpRequest() ){
            var_dump($request);
            return new JsonResponse(true);
         } 
         else {
            return new Response('No ajax here', 400);
         }
    }
    
}