<?php

namespace Zerodine\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\BrowserKit\Request;
use Zerodine\DashboardBundle\Boxes\Box;
use Zerodine\DashboardBundle\Boxes\Sources\FinanceSource;
use Zerodine\DashboardBundle\Boxes\Sources\LinesofcodeSource;
use Zerodine\DashboardBundle\Boxes\Sources\LogoSource;
use Zerodine\DashboardBundle\Boxes\Sources\TimeSource;
use Zerodine\DashboardBundle\Boxes\Sources\TwitterSource;

class DashboardController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function mainAction()
    {
        $boxes = array();
        $boxes[] = Box::getInstance(new TwitterSource($this->get('dashboard_twitter')))->setStyle(Box::DASHUNIT);

        $boxes[] = Box::getInstance(new TwitterSource($this->get('dashboard_twitter'), TwitterSource::FOLLOWERS))->setStyle(Box::HALFUNIT);
        $boxes[] = Box::getInstance(new FinanceSource($this->get('blackoptic.xero.client')))->setStyle(Box::HALFUNIT);

        $boxes[] = Box::getInstance(new LinesofcodeSource('php'))->setStyle(Box::HALFUNIT);
        $boxes[] = Box::getInstance(new LinesofcodeSource('python'))->setStyle(Box::HALFUNIT);

        $boxes[] = Box::getInstance(new LogoSource())->setStyle(Box::HALFUNIT);
        $boxes[] = Box::getInstance(new TimeSource())->setStyle(Box::HALFUNIT);

        // next Row
        $boxes[] = Box::getInstance(new LinesofcodeSource('commits', 'commits'))->setStyle(Box::HALFUNIT);

        return array('boxes' => $boxes);
    }

    /**
     * @Route("/demo")
     * @Template()
     */
    public function demoAction() {
        return array();
    }
}
