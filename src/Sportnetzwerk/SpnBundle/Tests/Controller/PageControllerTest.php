<?php

namespace Sportnetzwerk\SpnBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class PageControllerTest extends WebTestCase
{
    public function testFaq(){
        $client = static::createClient(array(),array('HTTPS' => true));
        $crawler = $client->request('GET', '/faq');
        //trigger_error(var_export($crawler->getInfo(), true));
        $this->assertEquals(1, $crawler->filter('#content')->count());
    }
}
