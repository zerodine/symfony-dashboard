<?php
/**
 * Created by PhpStorm.
 * User: tspycher
 * Date: 23/06/14
 * Time: 16:31
 */

namespace Zerodine\DashboardBundle\Twig;


use Zerodine\DashboardBundle\Boxes\Box;

class BoxExtension extends \Twig_Extension {

    private $environment;

    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('box', array($this, 'loadBox')),
        );
    }

    public function loadBox(Box $box) {
        return $this->environment->render(sprintf("ZerodineDashboardBundle:Boxes:%s.html.twig", $box->getMacroname()), array('box'=>$box));
    }

    public function getName()
    {
        return 'box_extension';
    }
}