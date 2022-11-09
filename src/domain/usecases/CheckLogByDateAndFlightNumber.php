<?php

namespace App\domain\usecases;

interface CheckLogByDateAndFlightNumber {
  public function handle(String $date, String $flight_number) :bool;
}