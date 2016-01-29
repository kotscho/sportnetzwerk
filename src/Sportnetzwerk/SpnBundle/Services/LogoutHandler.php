<?php

namespace Sportnetzwerk\SpnBundle\Services;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;
use \Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Sportnetzwerk\SpnBundle\Entity\Player;

class LogoutHandler implements LogoutHandlerInterface
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
    public function logout(Request $request, Response $response, TokenInterface $token) {
        //trigger_error(var_export($token->getUsername() , 1));
        $this->em
              ->getRepository('SportnetzwerkSpnBundle:Player')
              ->updateOnlineFlag($token->getUsername(), 0);
        return;
    }
}