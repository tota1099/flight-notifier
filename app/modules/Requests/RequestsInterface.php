<?php

namespace App\modules\Requests;

interface RequestsInterface {
    
    public function get(String $url) : bool;
}

