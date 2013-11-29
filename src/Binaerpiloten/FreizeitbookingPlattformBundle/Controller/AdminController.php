<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $regions = $em->getRepository('Binaerpiloten\FreizeitbookingPlattformBundle\Entity\Region')->findAll();
        $providerTypes = array('Gokart', 'Lasertag', 'Paintball', 'Squash');

        foreach ($regions as $region) {
            foreach ($providerTypes as $providerType) {
                $q = $em->createQuery("SELECT COUNT(p) " .
                    "FROM Binaerpiloten\FreizeitbookingPlattformBundle\Entity\\$providerType" . "Provider p " .
                    "JOIN p.regions r " .
                    "WHERE r.id = " . $region->getId());
                $count = $q->getResult();
                $countdata[$region->getName()][$providerType] = $count[0][1];
            }
        }
        return $this->render('BinaerpilotenFreizeitbookingPlattformBundle:Admin:index.html.twig', array('countdata' => $countdata, 'providerTypes'=>$providerTypes));
    }
}
