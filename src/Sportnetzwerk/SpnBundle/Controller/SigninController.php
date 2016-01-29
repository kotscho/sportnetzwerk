<?php
/**
 * @depracated code
 *
 */
namespace Sportnetzwerk\SpnBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sportnetzwerk\SpnBundle\Entity\Player;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;  
use Symfony\Component\HttpFoundation\JsonResponse; 

class SigninController extends Controller
{
    public function loginAction(Request $request)
    {
        trigger_error(var_export($request, true));
        //die();
        if( $request->getMethod() == 'POST' && $request->isXMLHttpRequest()){
            if( $this->getDoctrine()
              ->getRepository('SportnetzwerkSpnBundle:Player')
              ->login($request->request->get('_username'), $request->request->get('_password')) ){
                /*  
                $this->getDoctrine()
                    ->getRepository('SportnetzwerkSpnBundle:Player')
                    ->updateOnlineFlag($request->request->get('_username'), 1);
                  */  
                    return new JsonResponse(array('data' => 'Credentials ok'), 200);
            }
            else{
                return new JsonResponse(array('data' => 'Username/Password is wrong'), 400);
                //return $this->redirect($request->headers->get('referer'));
            }
        }
        return new Response('This action is not allowed', 400);//build error landing page
    }
}