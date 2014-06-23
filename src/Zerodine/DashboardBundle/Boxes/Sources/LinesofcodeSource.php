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
    protected $unit;

    public function __construct($lang, $unit = 'lines') {
        $this->lang = $lang;
        $this->unit = $unit;
    }
    public function getMacroname()
    {
        return "linesofcode";
    }

    public function getTitle()
    {
        if($this->unit == 'commits') {
            return "Commits";
        }
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

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }


}