<?php

namespace App\presentation\controllers;
use App\presentation\interfaces\Notifier;
use App\domain\usecases\Planes;
use App\presentation\services\PlaneMessage;

class NotifyPlanes {

  private Notifier $notifier;
  
  public function __construct(Notifier $notifier)
  {
    $this->notifier = $notifier;    
  }

  public function handle(Planes $planes) {
    foreach($planes as $plane) {
      $message = PlaneMessage::handle($plane);
      $this->notifier->notify($message);
    }
  }
}