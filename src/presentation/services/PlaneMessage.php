<?php

namespace App\presentation\services;

use App\domain\usecases\PlaneModel;
use App\domain\usecases\PlaneTypes;

class PlaneMessage {

  public static function handle(PlaneModel $plane) {
    $message = 'Vôo ' . $plane->flightNumber . ' da empresa ' . $plane->airline . ' vai ';
    if($plane->type == PlaneTypes::ARRIVAL) {
      $message.= 'CHEGAR no aeroporto ';
    } else if ($plane->type == PlaneTypes::DEPARTURE) {
      $message.= 'PARTIR do aeroporto ';
    }
    $message .= $plane->airport->name . ' ás ' . (new \DateTime($plane->timeScheduled))->format('H:i:s');
    return $message;
  }
}