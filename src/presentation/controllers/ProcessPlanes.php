<?php

namespace App\presentation\controllers;

use App\domain\usecases\Airport;
use App\domain\usecases\PlaneModel;
use App\domain\usecases\PlaneTypes;
use App\presentation\exceptions\ProcessPlanesException;
use App\presentation\helpers\Helper;

class ProcessPlanes {

  private static int $alertMinutes = 15;
  private static string $airportTargetIata = 'FLN';

  public static function handle(String $data) {
    if(empty($data)) {
      throw new ProcessPlanesException('Data param is required!');
    }
    if(!Helper::isValidJson($data)){
      throw new ProcessPlanesException('The param data needs to be a json!');
    }

    $dataToJson = json_decode($data, true);
    $planes = $dataToJson['data'];
    return array_map(fn($plane) => self::processPlane($plane) ,$planes);
  }

  public static function processPlane($plane) {  
    $planeType = PlaneTypes::ARRIVAL;
    if($plane['departure']['iata'] == self::$airportTargetIata ) {
      $planeType = PlaneTypes::DEPARTURE;
    }

    $airport = new Airport([
      'name' => $plane[$planeType]['airport'],
      'iata' => $plane[$planeType]['iata']
    ]);

    return new PlaneModel([
      'date' => $plane['flight_date'],
      'timeScheduled' => $plane[$planeType]['scheduled'],
      'timeEstimated' => $plane[$planeType]['estimated'],
      'airline' => $plane['airline']['name'],
      'flightNumber' => $plane['flight']['number'],
      'type' => $planeType,
      'airport' => $airport
    ]);
  }
}