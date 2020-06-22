<?php

namespace App\domain\usecases;

class Airport {
  public String $name;
  public String $iata;

  public function __construct(String $name, String $iata) {
    $this->name = $name;
    $this->iata = $iata;
  }
}