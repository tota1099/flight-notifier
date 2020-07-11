<?php

namespace App\main;

$raizFolder = __DIR__ . '/../..';

require_once($raizFolder . '/vendor/autoload.php');

use App\presentation\controllers\NotifyPlanes;
use App\domain\usecases\Planes;
use App\presentation\controllers\ProcessPlanes;
use Dotenv\Dotenv;
use App\main\factories\NotifierFactory;

$dotenv = Dotenv::createImmutable($raizFolder);
$dotenv->load();

$apiPlanes = file_get_contents("json_example.txt");
$planesProcessed = ProcessPlanes::handle($apiPlanes);

if(!empty($planesProcessed)) {
  $planes = new Planes();
  foreach($planesProcessed as $k => $plane) {
    $planes->offsetSet($k, $plane);
  }
  $notifier = NotifierFactory::createNotifier();
  $notifyPlanes = new NotifyPlanes($notifier);
  $notifyPlanes->handle($planes);
}