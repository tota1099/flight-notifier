<?php

namespace App\presentation\exceptions;

use Exception;

class ProcessFlightsException extends Exception {

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}