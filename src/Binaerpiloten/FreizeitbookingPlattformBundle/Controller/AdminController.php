<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction() {
        return $this->render('BinaerpilotenFreizeitbookingPlattformBundle:Admin:index.html.twig');
    }
    
    
}
