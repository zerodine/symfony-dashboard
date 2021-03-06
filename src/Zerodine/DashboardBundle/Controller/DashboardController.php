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
        //$boxes[] = Box::getInstance(new LinesofcodeSource('php'))->setStyle(Box::HALFUNIT);
        //$boxes[] = Box::getInstance(new LinesofcodeSource('php'))->setStyle(Box::HALFUNIT);

        $boxes[] = Box::getInstance(new TwitterSource($this->get('dashboard_twitter')))->setStyle(Box::DASHUNIT);

        $boxes[] = Box::getInstance(new TwitterSource($this->get('dashboard_twitter'), TwitterSource::FOLLOWERS))->setStyle(Box::HALFUNIT);
        $f = new FinanceSource($this->get('blackoptic.xero.client'));
        $f->setGoal(20000);
        $boxes[] = Box::getInstance($f)->setStyle(Box::DASHUNIT);

        $boxes[] = Box::getInstance(new LogoSource('http://zerodine.com/wp-content/uploads/2014/06/vertical_500px_png_bw_w-300x158.png'))
            ->setStyle(Box::HALFUNIT)
            ->setCustomCss('background-color: transparent;background-image: none;border: 1px solid transparent;');
        $boxes[] = Box::getInstance(new TimeSource())->setStyle(Box::HALFUNIT);

        // next Row
        $boxes[] = Box::getInstance(new LinesofcodeSource('php'))->setStyle(Box::HALFUNIT);
        $boxes[] = Box::getInstance(new LinesofcodeSource('python'))->setStyle(Box::HALFUNIT);

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
