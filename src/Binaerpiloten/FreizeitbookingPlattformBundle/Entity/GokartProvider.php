<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GokartProvider
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class GokartProvider extends ActivityProvider {
    /**
     * @var string
     *
     * @ORM\Column(name="length", type="string", nullable=true)
     */
    private $length;

    /**
     * Set length
     */
    public function setLength($length) {
        $this->length = $length;
        return $this;
    }

    /**
     * Get length
     */
    public function getLength() {
        return $this->length;
    }
}
