<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diese Klasse stellt abstrakte Vorgaben für alle Entites zur Verfügung
 *
 * @author bene
 *
 * @ORM\MappedSuperclass
 *
 */
class Entity {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }
}
