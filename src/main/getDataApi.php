<?php

namespace App\main;

require_once('vendor/autoload.php');

use App\config\Config;
use App\main\factories\RequestFactory;

Config::init();

$apiUrl = $_ENV['API_URL'] . "/flights?";
$apiUrl .= "access_key=" . $_ENV['API_KEY'];
$apiUrl .= "&dep_iata=" . $_ENV['AIRPORT'];

$request = RequestFactory::createRequest();
$apiData = $request->get($apiUrl);

$json = json_decode($apiData);
$fp = fopen('data/flights.txt', 'w');
fwrite($fp, json_encode($json, JSON_PRETTY_PRINT));
fclose($fp);