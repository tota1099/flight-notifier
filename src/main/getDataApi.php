<?php

namespace App\main;

require_once('vendor/autoload.php');

use App\config\Config;
use App\main\factories\RequestFactory;

Config::init();

$apiUrl = $_ENV['API_URL'] . "/flights?";
$apiUrl .= "access_key=" . $_ENV['API_KEY'];

$request = RequestFactory::createRequest();
$apiDataDeparture = $request->get($apiUrl . "&dep_iata=" . $_ENV['AIRPORT']);
$apiDataArrive = $request->get($apiUrl . "&arr_iata=" . $_ENV['AIRPORT']);

$jsonDeparture = json_decode($apiDataDeparture, true);
$jsonArrive = json_decode($apiDataArrive, true);
$voos = array_merge($jsonArrive["data"], $jsonDeparture["data"]);
$fp = fopen('data/flights.txt', 'w');
fwrite($fp, json_encode(array_merge($voos) , JSON_PRETTY_PRINT));
fclose($fp);