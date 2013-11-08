<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity category
 *
 * @author bene
 *
 * @ORM\Entity
 *
 */
class Category extends Entity {
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="SEOText",mappedBy="category")
     */
    protected $seotexts;

    public function __construct() {
        $this->seotexts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getSEOTexts() {
        return $this->seotexts;
    }

    public function __toString() {
        return $this->name;
    }
}
