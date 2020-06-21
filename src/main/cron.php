<?php

namespace App\main;

require_once(__DIR__ . '/../../vendor/autoload.php');

use App\utils\Requests\CurlRequest;
use App\utils\Notifiers\Telegram\TelegramNotifier;
use App\presentation\controllers\NotifyPlanes;
use App\domain\usecases\PlaneModel;
use App\domain\usecases\Planes;
use App\domain\usecases\Airport;
use App\domain\usecases\PlaneTypes;

$airport = new Airport([
  'name' => 'Florianópolis',
  'iata' => 'FLN'
]);

$plane = new PlaneModel([
  'date' => '2020-05-21',
  'timeScheduled' => '2020-05-21T19:55:00+00:00',
  'timeEstimated' => '2020-05-21T19:55:00+00:00',
  'airline' => 'LATAM',
  'flightNumber' => 123456,
  'type' => PlaneTypes::DEPARTURE,
  'airport' => $airport
]);
$planes = new Planes();
$planes->offsetSet(1, $plane);
$request = new CurlRequest();
$notifier = new TelegramNotifier($request);
$notifyPlanes = new NotifyPlanes($notifier);
$notifyPlanes->handle($planes);