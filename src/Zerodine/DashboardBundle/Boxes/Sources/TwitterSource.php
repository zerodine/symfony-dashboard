<?php
/**
 * Created by PhpStorm.
 * User: tspycher
 * Date: 21/06/14
 * Time: 21:26
 */

namespace Zerodine\DashboardBundle\Boxes\Sources;


use Zerodine\DashboardBundle\Twitter\Twitter;

class TwitterSource implements SourceInterface {

    const TWEETS = "tweets";
    const FOLLOWERS = "followers";

    protected $twitter;
    protected $type;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    public function getUsername() {
        return $this->twitter->getUsername();
    }

    public function getMacroname()
    {
        return "twitter";
    }

    public function getTitle()
    {
        return "Twitter Widget";
    }

    public function getValue()
    {
        switch($this->type) {
            case self::TWEETS:
                return $this->twitter->collect(2);
            case self::FOLLOWERS:
                return $this->twitter->followers();
            default:
                return False;
        }
    }

    function __construct(Twitter $twitter, $type = TwitterSource::TWEETS) {
        $this->twitter = $twitter;
        $this->type = $type;
    }
}