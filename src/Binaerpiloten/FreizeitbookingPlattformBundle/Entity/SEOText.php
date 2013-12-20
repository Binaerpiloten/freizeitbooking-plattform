<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * SEO text
 *
 * @author bene
 *
 * @ORM\Entity
 *
 */
class SEOText extends Entity {
    // 'Enum' of all activity categories
    const CATEGORY_GOKART = 'Gokart';

    /**
     * @var string
     *
     * @ORM\Column(name="heading", type="string", length=255)
     */
    protected $heading;

    /**
     * @ORM\Column(name="text", type="text")
     */
    protected $text;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="metadescription", type="string", length=255)
     */
    protected $metadescription;

    /**
     * @ORM\ManyToOne(targetEntity="Region", inversedBy="seotexts")
     */
    protected $region;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="seotexts")
     */
    protected $category;

    public function getHeading() {
        return $this->heading;
    }

    public function setHeading($heading) {
        $this->heading = $heading;
    }

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function getRegion() {
        return $this->region;
    }

    public function setRegion($region) {
        if ($this->region !== null)
            $this->region->getSEOTexts()->remove($this);
        $this->region = $region;
        $region->getSEOTexts()->add($this);
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        if ($this->category !== null)
            $this->category->getSEOTexts()->remove($this);
        $this->category = $category;
        $category->getSEOTexts()->add($this);
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
