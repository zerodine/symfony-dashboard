<?php

namespace Zerodine\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\BrowserKit\Request;
use Zerodine\DashboardBundle\Boxes\Box;
use Zerodine\DashboardBundle\Boxes\Sources\LinesofcodeSource;
use Zerodine\DashboardBundle\Boxes\Sources\LogoSource;
use Zerodine\DashboardBundle\Boxes\Sources\TimeSource;

class DashboardController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function mainAction()
    {
        $boxes = array();
        $boxes[] = Box::getInstance(new TimeSource())->setStyle(Box::DASHUNIT);

        $boxes[] = Box::getInstance(new LogoSource())->setStyle(Box::HALFUNIT);
        $boxes[] = Box::getInstance(new TimeSource())->setStyle(Box::HALFUNIT);
        $boxes[] = Box::getInstance(new LogoSource())->setStyle(Box::HALFUNIT);

        $boxes[] = Box::getInstance(new TimeSource())->setStyle(Box::DASHUNIT);
        $boxes[] = Box::getInstance(new LinesofcodeSource('php'))->setStyle(Box::DASHUNIT);
        $boxes[] = Box::getInstance(new LinesofcodeSource('python'))->setStyle(Box::DASHUNIT);

        $boxes[] = Box::getInstance(new LogoSource())->setStyle(Box::HALFUNIT);
        $boxes[] = Box::getInstance(new TimeSource())->setStyle(Box::HALFUNIT);
        $boxes[] = Box::getInstance(new LogoSource())->setStyle(Box::HALFUNIT);
        $boxes[] = Box::getInstance(new LogoSource())->setStyle(Box::HALFUNIT);

        return array('boxes' => $boxes);
    }
}
