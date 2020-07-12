<?php

namespace App\presentation\interfaces;

interface RequestsInterface {
    
    public function get(String $url) : bool;
}

