<?php

namespace App\domain\usecases;

class NotifierLog {
  public FlightModel $flight;
  public String $date;

  public function __construct(String $flight, String $date) {
    $this->flight = $flight;
    $this->date = $date;
  }
}