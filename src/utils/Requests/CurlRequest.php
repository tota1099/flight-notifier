<?php

namespace App\utils\Requests;

class CurlRequest implements RequestsInterface {

    public function get(String $url = '') : bool {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);  
        return true;
    }
}

