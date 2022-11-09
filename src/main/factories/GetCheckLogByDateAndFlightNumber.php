<?php

namespace App\main\factories;

use App\domain\usecases\CheckLogByDateAndFlightNumber;
use App\data\usecases\DbCheckLogByDateAndFlightNumber;
use App\infra\database\sqlite\repositories\NotifierLogRepository;

class GetCheckLogByDateAndFlightNumber {
  public static function createGetNotifierLog(): CheckLogByDateAndFlightNumber
  {
    return new DbCheckLogByDateAndFlightNumber(new NotifierLogRepository());
  }
}