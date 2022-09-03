<?php

namespace App\presentation\interfaces;

use App\domain\usecases\FlightModel;

interface FlightMessage {
  public function handle(FlightModel $flights): String;
}
