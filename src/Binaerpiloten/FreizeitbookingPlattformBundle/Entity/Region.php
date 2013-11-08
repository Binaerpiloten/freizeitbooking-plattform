<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Region around a city
 *
 * @author bene
 *
 * @ORM\Entity
 *
 */
class Region extends Entity {
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="urlname", type="string", length=255)
     */
    protected $urlname;

    /**
     * 
     * @var string
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @ORM\ManyToMany(targetEntity="ActivityProvider", mappedBy="regions")
     */
    protected $providers;

    /**
     * @ORM\OneToMany(targetEntity="SEOText",mappedBy="region")
     */
    protected $seotexts;

    public function __construct() {
        $this->providers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->seotexts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getURLName() {
        return $this->urlname;
    }

    public function setURLName($urlname) {
        $this->urlname = $urlname;
    }

    public function addProvider($provider) {
        $provider->addRegion($this);
    }

    public function getProviders() {
        return $this->providers;
    }

    public function removeProvider($provider) {
        $provider->removeRegion($this);
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getSEOTexts() {
        return $this->seotexts;
    }

    public function __toString() {
        return $this->name;
    }
}
