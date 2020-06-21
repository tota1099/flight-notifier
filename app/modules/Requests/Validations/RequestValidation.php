<?php

namespace App\modules\Requests\Validations;

use App\modules\Requests\Exceptions\RequestException;

class RequestValidation {

    public static function urlIsValid($url) : void {
        if(!is_string($url) || empty($url)) {
            throw new RequestException('Url invalid!');
        }
    }
}