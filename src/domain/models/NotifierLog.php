<?php

namespace App\domain\models;

class NotifierLog {
  public String $flight_number;
  public String $date;

  public function __construct(String $flight_number, String $date) {
    $this->flight_number = $flight_number;
    $this->date = $date;
  }
}