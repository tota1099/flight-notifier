<?php

namespace App\data\interfaces;

interface GetNotifierLogRepository {
  public function getByDateAndFlightNumber(String $date, String $flight_number) :bool;
}