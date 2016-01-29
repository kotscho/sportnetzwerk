<?php

namespace Sportnetzwerk\SpnBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;


class SportsnewsController extends Controller {
    
    const RSS_FEED = 'http://rss.kicker.de/news/aktuell';
    
    const RSS_TEASER_MAX_VALUE = 15;
    
    public function renderFeedsAction(Request $request){
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Sportnetzwerk", $this->get("router")->generate("sportnetzwerk_spn_homepage"));
        $breadcrumbs->addItem("Aktuelle Sportnachrichten");
        /**
         * feed object is an instance of Zend.Feed.Reader.Feed.FeedInterface
         */
        $reader = $this->get('eko_feed.feed.reader');
        $feed  = $reader->load(self::RSS_FEED)->get();
       
        foreach ($feed as $entry) {
            $contentArray = explode(' ', strip_tags($entry->getContent()));
            $content = $entry->getDescription();
            if( count( $contentArray ) > self::RSS_TEASER_MAX_VALUE ){
                $content = implode(' ',array_slice($contentArray, 0, 60));
            }
            foreach ( $entry->getCategories() as $category ){
                $categoryValues[] = $category['term'];
            }
            //trigger_error(var_export($categoryValues, true));
            /*
             * @todo Create Service: find/extract the correct item category(sport) from categoryValues and assign 
             * the appropriate image for each item
             * People per Hour might be the plattform to hire a designer for those images
             */
            $edata = array(
            'title'        => $entry->getTitle(),
            'category'   => implode('---',$categoryValues ),
            'description'  => $entry->getDescription(),
            'dateModified' => $entry->getDateModified(),
            'authors'      => $entry->getAuthors(),
            'link'         => $entry->getLink(),
            'content'      => strip_tags($content).'...',
            );
            $data[] = $edata;
            unset($categoryValues);
        }
        return $this->render('SportnetzwerkSpnBundle:Sportsnews:sportsnews.html.twig', array('items' => $data));
    }
    
    
    
}
