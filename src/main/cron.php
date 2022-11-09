<?php

namespace App\main;

require_once('vendor/autoload.php');

use App\config\Config;
use App\presentation\controllers\NotifyFlights;
use App\presentation\services\ProcessFlights;
use App\main\factories\NotifierFactory;
use App\main\factories\AddNotifierLogFactory;
use App\main\factories\GetCheckLogByDateAndFlightNumber;
use App\presentation\services\FlightMessage;
use App\presentation\helpers\TimeHelper;

Config::init();

$timeNotification = $_ENV['NOTIFICATION_MINUTES'];
$airport = $_ENV['AIRPORT']; 
$apiFlights = file_get_contents("data/flights.txt");
$flightsProcessed = ( new ProcessFlights(new TimeHelper(), $timeNotification, $airport))->handle($apiFlights);
$flightMessage = new FlightMessage();

if(!empty($flightsProcessed)) {
  $notifier = NotifierFactory::createNotifier();
  $notifierLog = AddNotifierLogFactory::createAddNotifierLog();
  $notifierGetLog = GetCheckLogByDateAndFlightNumber::createGetNotifierLog();
  $notifyFlights = new NotifyFlights($notifier, $notifierLog, $notifierGetLog, $flightMessage);
  $notifyFlights->handle($flightsProcessed);
}