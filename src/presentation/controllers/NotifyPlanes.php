<?php

namespace App\presentation\controllers;
use App\presentation\interfaces\Controller;
use App\presentation\interfaces\Notifier;
use App\domain\usecases\Planes;

class NotifyPlanes {

  private Notifier $notifier;
  
  public function __construct(Notifier $notifier)
  {
    $this->notifier = $notifier;    
  }

  public function handle(Planes $planes) {
    foreach($planes as $plane) {
      $this->notifier->notify($plane);
    }
  }
}