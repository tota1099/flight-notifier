<?php

namespace App\presentation\exceptions;

use Exception;

class ProcessPlanesException extends Exception {

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}