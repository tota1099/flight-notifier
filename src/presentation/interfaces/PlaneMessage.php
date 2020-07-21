<?php

namespace App\presentation\interfaces;

use App\domain\usecases\PlaneModel;

interface PlaneMessage {
  public function handle(PlaneModel $planes): String;
}
