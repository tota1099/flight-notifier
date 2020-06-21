<?php

namespace App\presentation\interfaces;
use App\domain\usecases\PlaneModel;

interface Notifier {
  public function notify(PlaneModel $plane): bool;
}
