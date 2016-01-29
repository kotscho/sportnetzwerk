<?php
namespace Sportnetzwerk\SpnBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sportnetzwerk\SpnBundle\Entity\Player;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\JsonResponse; 

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        //trigger_error('what');
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }
        //kdos - getting: Symfony\Component\Security\Core\Exception\BadCredentialsException
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);
 
        if( empty($lastUsername) ) {
            //present login template - perform login
            return $this->render('SportnetzwerkSpnBundle:Page:signin.html.twig');
        }
        
        if (empty($error) ) {
            //use a playerrepo method here to set the user online!
            
            //trigger_error('huuuuh'.$lastUsername);
            $this->getDoctrine()
              ->getRepository('SportnetzwerkSpnBundle:Player')
              ->updateOnlineFlag($lastUsername, 1);
              
             
            return new JsonResponse(array('data' => 'Credentials ok'), 200);
        }
        return new JsonResponse(array('data' => 'Username/Password is wrong'), 400);
    }
}