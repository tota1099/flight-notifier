<?php

namespace App\utils\Requests;

interface RequestsInterface {
    
    public function get(String $url) : bool;
}

