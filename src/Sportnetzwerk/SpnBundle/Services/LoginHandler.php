<?php

namespace Sportnetzwerk\SpnBundle\Services;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use \Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse; 
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Sportnetzwerk\SpnBundle\Entity\Player;

class LoginHandler implements AuthenticationSuccessHandlerInterface
{
    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }
    /**
     * 
     * @param Request $request
     * @param Response $response
     * @param TokenInterface $token
     * @return void
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {
        //trigger_error(var_export($token->getUsername() , 1));
        $this->em
              ->getRepository('SportnetzwerkSpnBundle:Player')
              ->updateOnlineFlag($token->getUsername(), 1);
        //kdos: must have when using an ajax login
        return new JsonResponse(array('data' => 'Credentials ok'), 200);
    }
}