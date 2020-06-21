<?php

namespace App\presentation\controllers;

use App\presentation\exceptions\ProcessPlanesException;
use App\presentation\helpers\Helper;

class ProcessPlanes {

  public static function handle(String $data) {
    if(empty($data)) {
      throw new ProcessPlanesException('Data param is required!');
    }
    if(!Helper::isValidJson($data)){
      throw new ProcessPlanesException('The param data needs to be a json!');
    }
  }
}