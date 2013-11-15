<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaintballProvider
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PaintballProvider extends ActivityProvider
{
    
    /**
     * @ORM\Column(name="indoorFieldCount", type="integer")
     */
    private $indoorFieldCount;

    /**
     * @ORM\Column(name="outdoorFieldCount", type="integer")
     */
    private $outdoorFieldCount;


    
    /**
     * Set indoorFieldCount
     *
     * @param integer $indoorFieldCount
     * @return PaintballProvider
     */
    public function setIndoorFieldCount($indoorFieldCount)
    {
        $this->indoorFieldCount = $indoorFieldCount;
    
        return $this;
    }

    /**
     * Get indoorFieldCount
     *
     * @return integer 
     */
    public function getIndoorFieldCount()
    {
        return $this->indoorFieldCount;
    }

    /**
     * Set outdoorFieldCount
     *
     * @param integer $outdoorFieldCount
     * @return PaintballProvider
     */
    public function setOutdoorFieldCount($outdoorFieldCount)
    {
        $this->outdoorFieldCount = $outdoorFieldCount;
    
        return $this;
    }

    /**
     * Get outdoorFieldCount
     *
     * @return integer 
     */
    public function getOutdoorFieldCount()
    {
        return $this->outdoorFieldCount;
    }
}
