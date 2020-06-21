<?php

namespace App\modules\Notifiers;

use App\modules\Requests\RequestsInterface;

interface NotifierInterface {
    
    public function notify(RequestsInterface $request, String $message) : bool;
}

