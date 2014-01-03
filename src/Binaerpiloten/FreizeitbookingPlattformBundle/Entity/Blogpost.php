<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Blog post
 *
 * @author bene
 *
 * @ORM\Entity
 *
 */
class Blogpost extends Entity {
    /**
     * @var string
     *
     * @ORM\Column(name="heading", type="string", length=255)
     */
    protected $heading;

    /**
     * @ORM\Column(name="teaser", type="text")
     */
    protected $teaser;

    /**
     * @ORM\Column(name="text", type="text")
     */
    protected $text;

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
     * @ORM\Column(name="urlname", type="string", length=255, unique=true)
     */
    protected $urlName;

    /**
     * @var string
     *
     * @ORM\Column(name="linkcaption", type="string", length=255)
     */
    protected $linkcaption;

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

    public function getTeaser() {
        return $this->teaser;
    }

    public function setTeaser($teaser) {
        $this->teaser = $teaser;
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

    public function getUrlName() {
        return $this->urlName;
    }

    public function setUrlName($urlName) {
        $this->urlName = $urlName;
    }

    public function getLinkcaption() {
        return $this->linkcaption;
    }

    public function setLinkcaption($linkcaption) {
        $this->linkcaption = $linkcaption;
    }

}
