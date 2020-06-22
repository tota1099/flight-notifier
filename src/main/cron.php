<?php

namespace App\main;

require_once(__DIR__ . '/../../vendor/autoload.php');

use App\utils\Requests\CurlRequest;
use App\utils\Notifiers\Telegram\TelegramNotifier;
use App\presentation\controllers\NotifyPlanes;
use App\domain\usecases\Planes;
use App\presentation\controllers\ProcessPlanes;

$apiPlanes = file_get_contents("json_example.txt");
$planesProcessed = ProcessPlanes::handle($apiPlanes);

if(!empty($planesProcessed)) {
  $planes = new Planes();
  foreach($planesProcessed as $k => $plane) {
    $planes->offsetSet($k, $plane);
  }

  $request = new CurlRequest();
  $notifier = new TelegramNotifier($request);
  $notifyPlanes = new NotifyPlanes($notifier);
  $notifyPlanes->handle($planes);
}