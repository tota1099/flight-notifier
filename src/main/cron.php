<?php

namespace App\main;

require_once('vendor/autoload.php');

use App\config\Config;
use App\presentation\controllers\NotifyPlanes;
use App\presentation\services\ProcessPlanes;
use App\main\factories\NotifierFactory;

Config::init();

$apiPlanes = file_get_contents("data/planes.json");
$planesProcessed = ProcessPlanes::handle($apiPlanes);

if(!empty($planesProcessed)) {
  $notifier = NotifierFactory::createNotifier();
  $notifyPlanes = new NotifyPlanes($notifier);
  $notifyPlanes->handle($planesProcessed);
}