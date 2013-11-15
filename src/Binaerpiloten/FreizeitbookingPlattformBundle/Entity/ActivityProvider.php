<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Provider of a spare time activity
 *
 * @author bene
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 *
 */
class ActivityProvider extends Entity {
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(name="claim", type="string", length=255)
     */
    protected $claim;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255)
     */
    protected $street;

    /**
     * @var string
     *
     * @ORM\Column(name="zip", type="string", length=255)
     */
    protected $zip;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    protected $city;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    protected $price;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    protected $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255)
     */
    protected $website;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="blob")
     */
    protected $image;

    /**
     * @ORM\ManyToMany(targetEntity="Region", inversedBy="providers")
     */
    protected $regions;

    public function __construct() {
        $this->regions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ActivityProvider
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return ActivityProvider
     */
    public function setStreet($street) {
        $this->street = $street;
        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet() {
        return $this->street;
    }

    /**
     * Set zip
     *
     * @param string $zip
     * @return ActivityProvider
     */
    public function setZip($zip) {
        $this->zip = $zip;
        return $this;
    }

    /**
     * Get zip
     *
     * @return string
     */
    public function getZip() {
        return $this->zip;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return ActivityProvider
     */
    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return ActivityProvider
     */
    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return ActivityProvider
     */
    public function setTelephone($telephone) {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone() {
        return $this->telephone;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return ActivityProvider
     */
    public function setImage($image) {
        $this->image = $image;
        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Adds a region
     * 
     * @param Region $region
     */
    public function addRegion($region) {
        $region->getProviders()->add($region);
        $this->regions->add($region);
    }

    /**
     * Returns the collection of regions
     */
    public function getRegions() {
        return $this->regions;
    }

    /**
     * Removes a region from this provider's list
     *
     * @param Region $region
     */
    public function removeRegion($region) {
        $region->getProviders()->remove($region);
        $this->regions->remove($region);
    }

    public function __toString() {
        return $this->name;
    }

    public function getWebsite() {
        return $this->website;
    }

    public function setWebsite($website) {
        $this->website = $website;
    }

    public function getClaim() {
        return $this->claim;
    }

    public function setClaim($claim) {
        $this->claim = $claim;
    }

}
