<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LasertagProvider
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class LasertagProvider extends ActivityProvider {

    /**
     * @var integer
     *
     * @ORM\Column(name="maxPlayer", type="integer")
     */
    private $maxPlayer;

    /**
     * Set maxPlayer
     *
     * @param integer $maxPlayer
     * @return LasertagProvider
     */
    public function setMaxPlayer($maxPlayer)
    {
        $this->maxPlayer = $maxPlayer;

        return $this;
    }

    /**
     * Get maxPlayer
     *
     * @return integer 
     */
    public function getMaxPlayer()
    {
        return $this->maxPlayer;
    }
}
