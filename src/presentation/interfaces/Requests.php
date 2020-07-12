<?php

namespace App\presentation\interfaces;

interface Requests {
    
    public function get(String $url) : bool;
}

