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
     * @ORM\Column(name="text", type="text")
     */
    protected $text;

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
}
