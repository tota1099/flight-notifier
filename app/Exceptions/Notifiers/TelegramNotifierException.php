<?php

namespace App\Exceptions\Notifiers;

use Exception;

class TelegramNotifierException extends Exception{

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}