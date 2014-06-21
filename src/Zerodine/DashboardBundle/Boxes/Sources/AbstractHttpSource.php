<?php
/**
 * Created by PhpStorm.
 * User: tspycher
 * Date: 20/06/14
 * Time: 22:44
 */

namespace Zerodine\DashboardBundle\Boxes\Sources;


abstract class AbstractHttpSource implements SourceInterface {
    public function get($url) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url
            ));
        $resp = curl_exec($curl);
        curl_close($curl);
        return json_decode($resp);
    }
} 