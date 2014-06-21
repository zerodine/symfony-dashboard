<?php
/**
 * Created by PhpStorm.
 * User: tspycher
 * Date: 20/06/14
 * Time: 22:38
 */

namespace Zerodine\DashboardBundle\Boxes\Sources;


class LogoSource implements SourceInterface {

    public function getMacroname()
    {
        return "logo";
    }

    public function getTitle()
    {
        return "Zerodine";
    }

    public function getValue() {
        return 'http://zerodine.com/wp-content/uploads/2014/05/zerodine_logo_wp.jpg';
    }
}