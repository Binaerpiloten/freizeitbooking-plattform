<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Twig;

class RegionExtension extends \Twig_Extension {

    protected $em;

    public function __construct($em) {
        $this->em = $em;
    }

    public function getFunctions() {
        return array(new \Twig_SimpleFunction('globalGetRegions', array($this, 'globalGetRegions')));
    }

    public function globalGetRegions() {
        return $this->em->getRepository('Binaerpiloten\FreizeitbookingPlattformBundle\Entity\Region')->findAll();
    }

    public function getName()
    {
        return 'region_extension';
    }
}