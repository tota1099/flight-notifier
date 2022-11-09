<?php

namespace App\data\usecases;

use App\domain\usecases\CheckLogByDateAndFlightNumber;
use App\data\interfaces\AddNotifierLogRepository;
use App\domain\models\NotifierLog;
use App\data\interfaces\GetNotifierLogRepository;

class DbCheckLogByDateAndFlightNumber implements CheckLogByDateAndFlightNumber {

  public function __construct(
    public GetNotifierLogRepository $repository
  ) {}

  public function handle(String $date, String $flight_number) :bool {
    return $this->repository->getByDateAndFlightNumber($date, $flight_number);
  }
}