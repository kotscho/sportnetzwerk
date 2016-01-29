<?php

namespace Sportnetzwerk\SpnBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\SecurityContext;

class ActivationController extends Controller {
    
    /**
     * 
     * @param type $id
     * @param type $token
     * @return ActivationController
     */
    public function activateAction($id, $token, Request $request)
    {
        if ($this->getDoctrine()
            ->getRepository('SportnetzwerkSpnBundle:Player')
            ->validatePlayerToken($id, $token))
        {
            $player = $this->getDoctrine()
                  ->getRepository('SportnetzwerkSpnBundle:Player')
                  ->retrievePlayer($id, $this->generateUrl('sportnetzwerk_spn_login'));

            $token =new UsernamePasswordToken(
                    $player,//should always be the whole user object (not just the username)
                    $player->getPassword(),
                    'secured_area',
                    $player->getRoles()
                    );
            $this->get('security.context')->setToken($token);
            $request->getSession()->set('_security_secured_area', serialize($token));
            
            $this->getDoctrine()
                  ->getRepository('SportnetzwerkSpnBundle:Player')
                  ->updateRegistrationFlag($player, 1);
            return $this->redirect($this->generateUrl('sportnetzwerk_spn_activation_done'));
        }
        else
        {
            return $this->render('SportnetzwerkSpnBundle:Activation:activate.html.twig', array('error' => true));
        }
                
    }
    
    public function doneAction()
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Sportnetzwerk", $this->get("router")->generate("sportnetzwerk_spn_homepage"));
        $breadcrumbs->addItem("Aktivierung abgeschlossen");
        return $this->render('SportnetzwerkSpnBundle:Activation:activate.done.html.twig');
    }
    
}