<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Users of the platform.
 *
 * WARNING: This class does not extend the Entity base class since it needs to extend
 * the base user class. TODO We should consider changing the Entity base class into a
 * >= PHP 5.4 trait so we can use it here as well.
 *
 * @ORM\Entity
 * @ORM\Table
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}
