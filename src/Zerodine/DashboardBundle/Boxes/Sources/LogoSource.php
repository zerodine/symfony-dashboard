<?php
/**
 * Created by PhpStorm.
 * User: tspycher
 * Date: 20/06/14
 * Time: 22:38
 */

namespace Zerodine\DashboardBundle\Boxes\Sources;


class LogoSource implements SourceInterface {

    protected $url;

    function __construct($url) {
        $this->url = $url;
    }

    public function getMacroname()
    {
        return "logo";
    }

    public function getTitle()
    {
        return "";
    }

    public function getValue() {
        return $this->url;
    }
}