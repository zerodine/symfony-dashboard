<?php
/**
 * Created by PhpStorm.
 * User: tspycher
 * Date: 20/06/14
 * Time: 19:15
 */

namespace Zerodine\DashboardBundle\Boxes;


use Zerodine\DashboardBundle\Boxes\Sources\SourceInterface;

class Box {
    const DASHUNIT = 'dash-unit';
    const HALFUNIT = 'half-unit';

    protected $style = null;
    protected $source = null;
    protected $custom_css = null;

    public function __construct(SourceInterface $source) {
        $this->source = $source;
        return $this;
    }

    static function getInstance(SourceInterface $source) {
        return new self($source);
    }

    /**
     * @return null|\Zerodine\DashboardBundle\Boxes\SourceInterface
     */
    public function getSource()
    {
        return $this->source;
    }


    /**
     * @param mixed $style
     */
    public function setStyle($style)
    {
        $this->style = $style;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @return mixed
     */
    public function getMacroname()
    {
        return $this->source->getMacroname();
    }

    /**
     * @param null $custom_css
     */
    public function setCustomCss($custom_css)
    {
        $this->custom_css = $custom_css;
        return $this;
    }

    /**
     * @return null
     */
    public function getCustomCss()
    {
        return $this->custom_css;
    }


} 