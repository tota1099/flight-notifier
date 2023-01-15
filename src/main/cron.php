<?php

namespace App\main;

require_once('vendor/autoload.php');

use App\config\Config;
use App\presentation\controllers\NotifyFlights;
use App\presentation\services\ProcessFlights;
use App\main\factories\NotifierFactory;
use App\presentation\services\FlightMessage;
use App\presentation\helpers\TimeHelper;
use App\data\usecases\DbAddNotifierLog;
use App\infra\database\postgres\NotifierLogRepository;

Config::init();

$timeNotification = $_ENV['NOTIFICATION_MINUTES'];
$airport = $_ENV['AIRPORT']; 
$apiFlights = file_get_contents("data/flights.txt");
$flightsProcessed = ( new ProcessFlights(new TimeHelper(), $timeNotification, $airport))->handle($apiFlights);
$flightMessage = new FlightMessage();
$dbAddNotifierLog = new DbAddNotifierLog(new NotifierLogRepository(), new TimeHelper());

if(!empty($flightsProcessed)) {
  $notifier = NotifierFactory::createNotifier();
  $notifyFlights = new NotifyFlights($notifier, $flightMessage, $dbAddNotifierLog);
  $notifyFlights->handle($flightsProcessed);
}