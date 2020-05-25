<?php

namespace App\Notifiers;

interface NotifierInterface {
    
    public function notify() : bool;
}

