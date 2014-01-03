<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WebsiteController extends Controller
{
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $blogposts = $em->getRepository('Binaerpiloten\FreizeitbookingPlattformBundle\Entity\Blogpost')->findAll();

        $regions = $this->getRegions();
        return $this->render('BinaerpilotenFreizeitbookingPlattformBundle:Website:index.html.twig', array('regions' => $regions, 'blogposts' => $blogposts));
    }

    public function gokartListAction($regionURLName) {
        return $this->renderGenericProviderList($regionURLName,'gokartlist.html.twig','Gokart','GokartProvider');
    }

    public function gokartDetailsAction($regionURLName, $id) {
        return $this->renderGenericProviderDetails($id,'gokartdetails.html.twig','GokartProvider');
    }

    public function paintballListAction($regionURLName) {
        return $this->renderGenericProviderList($regionURLName,'paintballlist.html.twig','Paintball','PaintballProvider');
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

    public function squashListAction($regionURLName) {
        return $this->renderGenericProviderList($regionURLName,'squashlist.html.twig','Squash','SquashProvider');
    }

    public function squashDetailsAction($regionURLName, $id) {
        return $this->renderGenericProviderDetails($id,'squashdetails.html.twig','SquashProvider');
    }

    public function impressumAction() {
        $regions = $this->getRegions();
        return $this->render('BinaerpilotenFreizeitbookingPlattformBundle:Website:impressum.html.twig', array('regions' => $regions));
    }

    public function contactAction() {
        $regions = $this->getRegions();
        return $this->render('BinaerpilotenFreizeitbookingPlattformBundle:Website:kontakt.html.twig', array('regions' => $regions));
    }

    public function showBlogpostAction($urlName) {
        $em = $this->getDoctrine()->getManager();
        $blogpost = $em->getRepository('Binaerpiloten\FreizeitbookingPlattformBundle\Entity\Blogpost')
                       ->findOneBy(array('urlName' => $urlName));

        $regions = $this->getRegions();
        return $this->render('BinaerpilotenFreizeitbookingPlattformBundle:Website:blogpost.html.twig', array('regions' => $regions, 'blogpost' => $blogpost));
    }

    // helper functions go here -----------------------------------------------------------------------

    protected function getRegions() {
        $em = $this->getDoctrine()->getManager();
        $regions = array(); 
        $regions['all'] = $em->getRepository('Binaerpiloten\FreizeitbookingPlattformBundle\Entity\Region')->findAll();
        
        $qgokart = $em->createQuery("SELECT DISTINCT r " .
                  		 "FROM Binaerpiloten\FreizeitbookingPlattformBundle\Entity\Region r " .
        				 "JOIN r.providers p " .
        				 "WHERE p INSTANCE OF Binaerpiloten\FreizeitbookingPlattformBundle\Entity\GokartProvider");

        $regions['gokart'] = $qgokart->getResult();

        $qlasertag = $em->createQuery("SELECT DISTINCT r " .
        		"FROM Binaerpiloten\FreizeitbookingPlattformBundle\Entity\Region r " .
        		"JOIN r.providers p " .
        		"WHERE p INSTANCE OF Binaerpiloten\FreizeitbookingPlattformBundle\Entity\LasertagProvider");
        
        $regions['lasertag'] = $qlasertag->getResult();
        
        $qpaintball = $em->createQuery("SELECT DISTINCT r " .
        		"FROM Binaerpiloten\FreizeitbookingPlattformBundle\Entity\Region r " .
        		"JOIN r.providers p " .
        		"WHERE p INSTANCE OF Binaerpiloten\FreizeitbookingPlattformBundle\Entity\PaintballProvider");
        
        $regions['paintball'] = $qpaintball->getResult();
        
        $qsquash = $em->createQuery("SELECT DISTINCT r " .
        		"FROM Binaerpiloten\FreizeitbookingPlattformBundle\Entity\Region r " .
        		"JOIN r.providers p " .
        		"WHERE p INSTANCE OF Binaerpiloten\FreizeitbookingPlattformBundle\Entity\SquashProvider");
        
        $regions['squash'] = $qsquash->getResult();
        
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

        return $this->render('BinaerpilotenFreizeitbookingPlattformBundle:Website:' . $templateName,
                array('region' => $region, 'seotext' => $seotext, 'regions' => $regions, 'providers' => $providers));
    }

    protected function renderGenericProviderDetails($id, $templateName, $providerEntityName) {
        $em = $this->getDoctrine()->getManager();
        $provider = $em->getRepository('Binaerpiloten\FreizeitbookingPlattformBundle\Entity\\' . $providerEntityName)
                       ->findOneBy(array('id' => $id));

        $regions = $this->getRegions();

        return $this->render('BinaerpilotenFreizeitbookingPlattformBundle:Website:'. $templateName,
                array('provider' =>$provider, 'regions' => $regions));
    }
}
