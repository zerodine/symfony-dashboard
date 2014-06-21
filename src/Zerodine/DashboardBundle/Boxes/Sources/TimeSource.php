<?php
/**
 * Created by PhpStorm.
 * User: tspycher
 * Date: 20/06/14
 * Time: 21:41
 */

namespace Zerodine\DashboardBundle\Boxes\Sources;


class TimeSource implements SourceInterface {

    public function getMacroname()
    {
        return 'time';
    }

    public function getTitle()
    {
        return "Time";
    }

    public function getValue()
    {
        return "";
    }
}