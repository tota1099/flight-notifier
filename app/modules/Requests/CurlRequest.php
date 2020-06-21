<?php

namespace App\modules\Requests;

use App\modules\Requests\Validations\RequestValidation;

class CurlRequest implements RequestsInterface {

    public function get(String $url = '') : bool {
        RequestValidation::urlIsValid($url);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);  
        return true;
    }
}

