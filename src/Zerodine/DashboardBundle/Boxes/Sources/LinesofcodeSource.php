<?php
/**
 * Created by PhpStorm.
 * User: tspycher
 * Date: 20/06/14
 * Time: 22:45
 */

namespace Zerodine\DashboardBundle\Boxes\Sources;


class LinesofcodeSource extends AbstractHttpSource {

    protected $lang;

    public function __construct($lang) {
        $this->lang = $lang;
    }
    public function getMacroname()
    {
        return "linesofcode";
    }

    public function getTitle()
    {
        return sprintf("Lines of Code - %s", $this->lang);
    }

    public function getValue()
    {
        $data = $this->get('http://zerodine.com/git_repos.json');
        if(property_exists($data, $this->lang)) {
            return $data->{$this->lang};
        }
        return 0;
    }
}