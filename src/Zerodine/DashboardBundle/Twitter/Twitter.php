<?php
/**
 * Created by PhpStorm.
 * User: tspycher
 * Date: 22/06/14
 * Time: 12:59
 */

namespace Zerodine\DashboardBundle\Twitter;


class Twitter {
    const USER_TIMELINE = "user_timeline";
    const MENTIONS_TIMELINE = "mentions_timeline";
    const HOME_TIMELINE = "home_timeline";
    const RETWEETS_OF_ME = "retweets_of_me";

    protected $username;
    protected $consumer_key;
    protected $consumer_secret;
    protected $oauth_access_token;
    protected $oauth_access_token_secret;

    function __construct($username, $consumer_key, $consumer_secret, $oauth_access_token, $oauth_access_token_secret)
    {
        $this->username = $username;
        $this->consumer_key = $consumer_key;
        $this->consumer_secret = $consumer_secret;
        $this->oauth_access_token = $oauth_access_token;
        $this->oauth_access_token_secret = $oauth_access_token_secret;
    }

    public function getUsername() {
        return $this->username;
    }

    public function followers() {
        $url = "followers/ids.json";
        $data = $this->call($url);
        if ($data) {
            return count($data['ids']);
        }

        return 0;
    }

    public function collect($num = 10) {
        $url = "statuses/".self::USER_TIMELINE.".json";
        //  create request
        $request = array(
            'screen_name'       => $this->username,
            'count'             => $num
        );

        $data = array();
        foreach($this->call($url, $request) as $tweet) {
            $data[strtotime($tweet['created_at'])] = array(
                'text' => $tweet['text'],
                'url' => sprintf('https://twitter.com/%s/status/%d',$this->username, $tweet['id']),
                'created_at' => $tweet['created_at']
            );
        }
        return $data;
    }

    static function buildBaseString($baseURI, $method, $params) {
        $r = array();
        ksort($params);
        foreach($params as $key=>$value){
            $r[] = "$key=" . rawurlencode($value);
        }
        return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
    }

    static function buildAuthorizationHeader($oauth) {
        $r = 'Authorization: OAuth ';
        $values = array();
        foreach($oauth as $key=>$value)
            $values[] = "$key=\"" . rawurlencode($value) . "\"";
        $r .= implode(', ', $values);
        return $r;
    }

    private function call($url, $params = array()){
        $url = "https://api.twitter.com/1.1/".$url;
        #$twitter_timeline           = "user_timeline";  //  mentions_timeline / user_timeline / home_timeline / retweets_of_me

        $oauth = array(
            'oauth_consumer_key'        => $this->consumer_key,
            'oauth_nonce'               => time(),
            'oauth_signature_method'    => 'HMAC-SHA1',
            'oauth_token'               => $this->oauth_access_token,
            'oauth_timestamp'           => time(),
            'oauth_version'             => '1.0'
        );

        //  merge request and oauth to one array
        $oauth = array_merge($oauth, $params);

        //  do some magic
        $base_info              = self::buildBaseString($url, 'GET', $oauth);
        $composite_key          = rawurlencode($this->consumer_secret) . '&' . rawurlencode($this->oauth_access_token_secret);
        $oauth_signature            = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
        $oauth['oauth_signature']   = $oauth_signature;

        //  make request
        $header = array(self::buildAuthorizationHeader($oauth), 'Expect:');
        $options = array( CURLOPT_HTTPHEADER => $header,
            CURLOPT_HEADER => false,
            CURLOPT_URL => $url."?". http_build_query($params),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false);

        $feed = curl_init();
        curl_setopt_array($feed, $options);
        $json = curl_exec($feed);
        curl_close($feed);

        return json_decode($json, true);
    }

} 