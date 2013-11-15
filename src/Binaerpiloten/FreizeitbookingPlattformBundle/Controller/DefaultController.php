<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $regions = $this->getRegions();
        return $this->render('BinaerpilotenFreizeitbookingPlattformBundle:Default:index.html.twig',
                array('regions' => $regions));
    }

    public function gokartListAction($regionURLName) {
        // retrieve all gokart providers from database
        $em = $this->getDoctrine()->getManager();
        $region = $em->getRepository('Binaerpiloten\FreizeitbookingPlattformBundle\Entity\Region')
                      ->findOneBy(array('urlname' => $regionURLName));

        if ($region === null)
            return new Response('Region unbekannt'); //TODO!

        $category = $em->getRepository('Binaerpiloten\FreizeitbookingPlattformBundle\Entity\Category')
                        ->findOneBy(array('name' => 'Gokart'));

        $q = $em->createQuery("select t from Binaerpiloten\FreizeitbookingPlattformBundle\Entity\SEOText t where t.region = " . $region->getId() . " and t.category = " . $category->getId());
        $result = $q->getResult();

        $seotext = empty($result) ? null : $result[0];

        $regions = $this->getRegions();

        return $this->render('BinaerpilotenFreizeitbookingPlattformBundle:Default:gokartlist.html.twig', 
                array('region' => $region, 'seotext' => $seotext, 'regions' => $regions));
    }

    public function gokartDetailsAction($regionURLName, $id) {
        $em = $this->getDoctrine()->getManager();
        $provider = $em->getRepository('Binaerpiloten\FreizeitbookingPlattformBundle\Entity\GokartProvider')
                       ->findOneBy(array('id' => $id));

        $regions = $this->getRegions();

        return $this->render('BinaerpilotenFreizeitbookingPlattformBundle:Default:gokartdetails.html.twig', 
                array('provider' =>$provider, 'regions' => $regions));
    }

    // helper functions go here

    protected function getRegions() {
        $em = $this->getDoctrine()->getManager();
        $regions = $em->getRepository('Binaerpiloten\FreizeitbookingPlattformBundle\Entity\Region')->findAll();
        return $regions;
    }
}
