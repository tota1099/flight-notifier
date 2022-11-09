<?php

namespace App\presentation\interfaces;

use App\domain\models\FlightModel;

interface FlightMessage {
  public function handle(FlightModel $flights): String;
}
