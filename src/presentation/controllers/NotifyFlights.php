<?php

namespace App\presentation\controllers;

use App\presentation\interfaces\Notifier;
use App\domain\models\Flights;
use App\presentation\interfaces\FlightMessage;

class NotifyFlights {

  private Notifier $notifier;
  private FlightMessage $flightsMessage;
  
  public function __construct(Notifier $notifier, FlightMessage $flightsMessage)
  {
    $this->notifier = $notifier;
    $this->flightsMessage = $flightsMessage;
  }

  public function handle(Flights $flights) {
    foreach($flights as $flights) {
      $message = $this->flightsMessage->handle($flights);
      $this->notifier->notify($message);
    }
  }
}