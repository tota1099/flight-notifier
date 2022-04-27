<?php

namespace App\main;

require_once('vendor/autoload.php');

use App\config\Config;
use App\presentation\controllers\NotifyPlanes;
use App\presentation\services\ProcessPlanes;
use App\main\factories\NotifierFactory;
use App\presentation\services\PlaneMessage;
use App\presentation\helpers\TimeHelper;

Config::init();

$timeNotification = $_ENV['NOTIFICATION_MINUTES'];
$airport = $_ENV['AIRPORT']; 
$apiPlanes = file_get_contents("data/planes.txt");
$planesProcessed = ( new ProcessPlanes(new TimeHelper(), $timeNotification, $airport))->handle($apiPlanes);
$planeMessage = new PlaneMessage();

if(!empty($planesProcessed)) {
  $notifier = NotifierFactory::createNotifier();
  $notifyPlanes = new NotifyPlanes($notifier, $planeMessage);
  $notifyPlanes->handle($planesProcessed);
}