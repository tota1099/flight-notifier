<?php

namespace App\presentation\controllers;

use App\presentation\interfaces\Notifier;
use App\domain\usecases\AddNotifierLog;
use App\domain\usecases\CheckLogByDateAndFlightNumber;
use App\domain\models\Flights;
use App\presentation\interfaces\FlightMessage;
use App\domain\models\NotifierLog;

class NotifyFlights {
  public function __construct(
    private Notifier $notifier,
    private AddNotifierLog $addNotifierLog,
    private CheckLogByDateAndFlightNumber $notifierGetLog,
    private FlightMessage $flightsMessage
  ) {}

  public function handle(Flights $flights) {
    foreach($flights as $flight) {
      if (!$this->notifierGetLog->handle($flight->date, $flight->flightNumber)) {
        $message = $this->flightsMessage->handle($flight);
        $this->notifier->notify($message);
        $this->addNotifierLog->add(new NotifierLog($flight->flightNumber, $flight->date));
      }
    }
  }
}