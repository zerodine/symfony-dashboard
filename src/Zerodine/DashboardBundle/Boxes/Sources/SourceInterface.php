<?php
/**
 * Created by PhpStorm.
 * User: tspycher
 * Date: 20/06/14
 * Time: 21:40
 */

namespace Zerodine\DashboardBundle\Boxes\Sources;


interface SourceInterface {
    public function getMacroname();
    public function getTitle();
    public function getValue();
} 