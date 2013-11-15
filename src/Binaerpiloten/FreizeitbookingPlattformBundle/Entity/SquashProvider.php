<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SquashProvider
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class SquashProvider extends ActivityProvider {
    /**
     * @var integer
     *
     * @ORM\Column(name="fieldCount", type="integer")
     */
    protected $fieldCount;

    /**
     * Set fieldCount
     *
     * @param integer $fieldCount
     * @return SquashProvider
     */
    public function setFieldCount($fieldCount) {
        $this->fieldCount = $fieldCount;
        return $this;
    }

    /**
     * Get fieldCount
     *
     * @return integer 
     */
    public function getFieldCount() {
        return $this->fieldCount;
    }
}
