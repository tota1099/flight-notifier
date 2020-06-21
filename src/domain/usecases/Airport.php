<?php

namespace App\domain\usecases;

class Airport {
  public String $name;
  public String $iata;

  public function __construct($airportData = []) {
    $this->name = $airportData['name'];
    $this->iata = $airportData['iata'];
  }
}