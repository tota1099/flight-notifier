<?php

namespace App\domain\usecases;

class AddNotifierLog {
  public FlightModel $flight;
  public String $date;

  public function __construct(FlightModel $flight, String $date) {
    $this->flight = $flight;
    $this->date = $date;
  }
}