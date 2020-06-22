<?php

namespace App\presentation\helpers;

class Helper {
  
  public static function isValidJson($string) {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
  }
}