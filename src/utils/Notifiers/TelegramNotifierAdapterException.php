<?php

namespace App\utils\Notifiers;

use Exception;

class TelegramNotifierAdapterException extends Exception{

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}