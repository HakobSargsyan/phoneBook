<?php

namespace Hs\PhoneBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HsPhoneBookBundle:Default:index.html.twig');
    }
}
