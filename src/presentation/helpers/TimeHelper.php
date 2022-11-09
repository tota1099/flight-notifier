<?php

namespace App\presentation\helpers;

use App\presentation\interfaces\Time;

class TimeHelper implements Time {
  
  public function now() : String {
    return date('Y-m-d H:i:s');
  }

  public function convertRFC3339ToDatetime(String $date) : String {
    return (new \DateTime($date))->format('Y-m-d H:i:s');
  }

  public function getDiffInMinutes(String $date1, String $date2) : int {
    return round((strtotime($date1) - strtotime($date2)) / 60);
  }
}