<?php

namespace App\presentation\controllers;

use App\presentation\exceptions\ProcessPlanesException;

class ProcessPlanes {

  public static function handle(String $data) {
    if(empty($data)) {
      throw new ProcessPlanesException('Data param is required!');
    }
  }
}