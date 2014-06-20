<?php

namespace Zerodine\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\BrowserKit\Request;

class DashboardController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function mainAction()
    {
        return array();
    }
}
