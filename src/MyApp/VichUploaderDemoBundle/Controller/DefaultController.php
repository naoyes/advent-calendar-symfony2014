<?php

namespace MyApp\VichUploaderDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MyAppVichUploaderDemoBundle:Default:index.html.twig', array('name' => $name));
    }
}
