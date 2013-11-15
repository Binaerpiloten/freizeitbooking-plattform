<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction() {
        $regions = $this->getRegions();
        return $this->render('BinaerpilotenFreizeitbookingPlattformBundle:Default:index.html.twig',
                array('regions' => $regions));
    }

    public function gokartListAction($regionURLName) {
        return $this->renderGenericProviderList($regionURLName,'gokartlist.html.twig','Gokart','GokartProvider');
    }

    public function gokartDetailsAction($regionURLName, $id) {
        return $this->renderGenericProviderDetails($id,'gokartdetails.html.twig','GokartProvider');
    }
    
    public function paintballListAction($regionURLName) {
    	return $this->renderGenericProviderList($regionURLName,'paintballlist.html.twig','Paintball');
    }
    
    public function paintballDetailsAction($regionURLName, $id) {
    	return $this->renderGenericProviderDetails($id,'paintballdetails.html.twig','PaintballProvider');
    }

    public function lasertagListAction($regionURLName) {
        return $this->renderGenericProviderList($regionURLName,'lasertaglist.html.twig','Lasertag','LasertagProvider');
    }

    public function lasertagDetailsAction($regionURLName, $id) {
        return $this->renderGenericProviderDetails($id,'lasertagdetails.html.twig','LasertagProvider');
    }


    // helper functions go here -----------------------------------------------------------------------

    protected function getRegions() {
        $em = $this->getDoctrine()->getManager();
        $regions = $em->getRepository('Binaerpiloten\FreizeitbookingPlattformBundle\Entity\Region')->findAll();
        return $regions;
    }

    protected function renderGenericProviderList($regionURLName, $templateName, $categoryName, $providerEntityName) {
        $em = $this->getDoctrine()->getManager();
        $region = $em->getRepository('Binaerpiloten\FreizeitbookingPlattformBundle\Entity\Region')
                     ->findOneBy(array('urlname' => $regionURLName));

        if ($region === null)
            return new Response('Region unbekannt'); //TODO!

        $category = $em->getRepository('Binaerpiloten\FreizeitbookingPlattformBundle\Entity\Category')
                       ->findOneBy(array('name' => $categoryName));
        if ($category === null)
        	return new Response('Kategorie unbekannt'); //TODO!
        
        $q1 = $em->createQuery("select t from Binaerpiloten\FreizeitbookingPlattformBundle\Entity\SEOText t where t.region = " . $region->getId() . " and t.category = " . $category->getId());
        $result = $q1->getResult();

        $seotext = empty($result) ? null : $result[0];

        $regions = $this->getRegions();

        $q2 = $em->createQuery("SELECT p " .
                               "FROM Binaerpiloten\FreizeitbookingPlattformBundle\Entity\\" . $providerEntityName . " p " .
                               "JOIN p.regions r " .
                               "WHERE r.id = " . $region->getId());
        $providers = $q2->getResult();

        return $this->render('BinaerpilotenFreizeitbookingPlattformBundle:Default:' . $templateName,
                array('region' => $region, 'seotext' => $seotext, 'regions' => $regions, 'providers' => $providers));
    }

    protected function renderGenericProviderDetails($id, $templateName, $providerEntityName) {
        $em = $this->getDoctrine()->getManager();
        $provider = $em->getRepository('Binaerpiloten\FreizeitbookingPlattformBundle\Entity\\' . $providerEntityName)
                       ->findOneBy(array('id' => $id));

        $regions = $this->getRegions();

        return $this->render('BinaerpilotenFreizeitbookingPlattformBundle:Default:'. $templateName,
                array('provider' =>$provider, 'regions' => $regions));
    }
}
