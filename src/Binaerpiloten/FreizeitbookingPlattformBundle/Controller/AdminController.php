<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction() {
    	$em = $this->getDoctrine()->getManager();
    	$regions = WebsiteController::getRegions($em);
        return $this->render('BinaerpilotenFreizeitbookingPlattformBundle:Admin:index.html.twig', array('regions'=> $regions));
    }
    
    
}
