<?php
/**
 * Created by PhpStorm.
 * User: tspycher
 * Date: 20/06/14
 * Time: 22:45
 */

namespace Zerodine\DashboardBundle\Boxes\Sources;


class LinesofcodeSource extends AbstractHttpSource {

    public function getMacroname()
    {
        return "linesofcode";
    }

    public function getTitle()
    {
        return "Lines of Code";
    }

    public function getValue()
    {
        $data = $this->get('http://zerodine.com/git_repos.json');
        #return number_format ( $data->php , 0 , '.' , '\'' );
        return $data->php;
    }
}