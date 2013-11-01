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
     * @var integer
     *
     * @ORM\Column(name="length", type="integer")
     */
    private $length;

    /**
     * Set length
     *
     * @param integer $length
     * @return GokartProvider
     */
    public function setLength($length) {
        $this->length = $length;
        return $this;
    }

    /**
     * Get length
     *
     * @return integer 
     */
    public function getLength() {
        return $this->length;
    }
}
