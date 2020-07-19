<?php

namespace App\infra\Requests;

use App\presentation\interfaces\Requests;

class CurlRequestAdapter implements Requests {

    public function get(String $url) : string {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($ch);
        curl_close($ch);  
        return $return;
    }
}

