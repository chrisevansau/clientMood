<?php

namespace Acme\ClientMoodBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeClientMoodBundle:Default:index.html.twig', array('name' => $name));
    }
}
