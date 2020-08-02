<?php

namespace App\presentation\controllers;

use App\presentation\interfaces\Notifier;
use App\domain\usecases\Planes;
use App\presentation\interfaces\PlaneMessage;

class NotifyPlanes {

  private Notifier $notifier;
  private PlaneMessage $planeMessage;
  
  public function __construct(Notifier $notifier, PlaneMessage $planeMessage)
  {
    $this->notifier = $notifier;
    $this->planeMessage = $planeMessage;
  }

  public function handle(Planes $planes) {
    foreach($planes as $plane) {
      $message = $this->planeMessage->handle($plane);
      $this->notifier->notify($message);
    }
  }
}