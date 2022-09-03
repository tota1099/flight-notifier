<?php

namespace App\presentation\services;

use App\domain\usecases\FlightModel;
use App\domain\usecases\FlightTypes;
use App\presentation\interfaces\FlightMessage as InterfacesFlightMessage;

class FlightMessage implements InterfacesFlightMessage {

  public function handle(FlightModel $flights): String {
    $message = 'Vôo ' . $flights->flightNumber . ' da empresa ' . $flights->airline . ' vai ';
    if($flights->type == FlightTypes::ARRIVAL) {
      $message.= 'CHEGAR no aeroporto ';
    } else if ($flights->type == FlightTypes::DEPARTURE) {
      $message.= 'PARTIR do aeroporto ';
    }
    $message .= $flights->airport->name . ' ás ' . (new \DateTime($flights->timeScheduled))->format('H:i:s');
    return $message;
  }
}