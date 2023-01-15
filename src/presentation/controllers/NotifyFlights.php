<?php

namespace App\presentation\controllers;

use App\presentation\interfaces\Notifier;
use App\domain\usecases\Flights;
use App\presentation\interfaces\FlightMessage;
use App\domain\usecases\AddNotifierLog;
use App\data\usecases\DbAddNotifierLog;

class NotifyFlights {

  public function __construct(
    public Notifier $notifier, 
    public FlightMessage $flightsMessage,
    public DbAddNotifierLog $dbAddNotifierLog
  ) {}

  public function handle(Flights $flights) {
    foreach($flights as $flight) {
      $message = $this->flightsMessage->handle($flight);
      $this->notifier->notify($message);
      $this->dbAddNotifierLog->handle($flight);
    }
  }
}