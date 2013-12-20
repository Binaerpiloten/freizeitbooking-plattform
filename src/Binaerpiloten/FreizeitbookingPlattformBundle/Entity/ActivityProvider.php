<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Provider of a spare time activity
 *
 * @author bene
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\Column(name="claim", type="string", length=255, nullable=true)
     */
    protected $claim;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255, nullable=true)
     */
    protected $street;

    /**
     * @var string
     *
     * @ORM\Column(name="zip", type="string", length=255, nullable=true)
     */
    protected $zip;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    protected $city;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="string", length=255, nullable=true)
     */
    protected $price;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255, nullable=true)
     */
    protected $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    protected $website;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="metadescription", type="string", length=255, nullable=true)
     */
    protected $metadescription;

    /**
     * @var string
     *
     * @ORM\Column(name="imagepath", type="string", length=255, nullable=true)
     */
    protected $imagepath;

    /**
     * @Assert\File(maxSize="6000000")
     */
    protected $image;

    /**
     * @ORM\ManyToMany(targetEntity="Region", inversedBy="providers")
     */
    protected $regions;

    private $tempImage;

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
    public function setImagepath($image) {
        $this->imagepath = $image;
        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImagepath() {
        return $this->imagepath;
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

    public function getAbsoluteImagepath() {
        return null === $this->imagepath ? null
                : $this->getUploadRootDir() . '/' . $this->imagepath;
    }

    public function getWebImagepath() {
        return null === $this->path ? null
                : $this->getUploadDir() . '/' . $this->imagepath;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'images/activityproviders';
    }

    /**
     * Sets image.
     *
     * @param UploadedFile $file
     */
    public function setImage(UploadedFile $image = null) {
        $this->image = $image;
        // check if we have an old image path
        if (isset($this->imagepath)) {
            // store the old name to delete after the update
            $this->temp = $this->imagepath;
            $this->imagepath = null;
        } else {
            $this->imagepath = 'initial';
        }
    }

    /**
     * Get image.
     *
     * @return UploadedFile
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function imageUpload() {
        if (null === $this->getImage()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getImage()->move($this->getUploadRootDir(), $this->imagepath);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir() . '/' . $this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->image = null;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preImageUpload() {
        if (null !== $this->getImage()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->imagepath = $filename . '.'
                    . $this->getImage()->guessExtension();
        }
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeImageUpload() {
        if ($file = $this->getAbsoluteImagePath()) {
            unlink($file);
        }
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getMetadescription() {
        return $this->metadescription;
    }

    public function setMetadescription($metadescription) {
        $this->metadescription = $metadescription;
    }

}
