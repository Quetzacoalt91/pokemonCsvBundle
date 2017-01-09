<?php

namespace Quetzacoalt\PokeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('QuetzacoaltPokeBundle:Default:index.html.twig');
    }
}
