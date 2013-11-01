<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BinaerpilotenFreizeitbookingPlattformBundle:Default:index.html.twig');
    }

    public function gokartListAction() {
        // retrieve all gokart providers from database
        $em = $this->getDoctrine()->getEntityManager();
        $providers = $em->getRepository('Binaerpiloten\FreizeitbookingPlattformBundle\Entity\GokartProvider')->findAll();

        return $this->render('BinaerpilotenFreizeitbookingPlattformBundle:Default:gokartlist.html.twig', 
                array('providers' => $providers));
    }
}
