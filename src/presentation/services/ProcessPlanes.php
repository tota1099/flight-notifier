<?php

namespace App\presentation\services;

use App\domain\usecases\Airport;
use App\domain\usecases\PlaneModel;
use App\domain\usecases\Planes;
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
    $planesToNotify = new Planes();
    foreach($planes as $key => $plane) {
      $planeProcessed = self::processPlane($plane);
      if($planeProcessed) {
        $planesToNotify->offsetSet($key, $planeProcessed);
      }
    }
    return $planesToNotify;
  }

  public static function processPlane($plane) {
    $alertInSeconds = self::$alertMinutes * 60;

    $planeType = PlaneTypes::ARRIVAL;
    if($plane['departure']['iata'] == self::$airportTargetIata ) {
      $planeType = PlaneTypes::DEPARTURE;
    }

    $datetimePlane = strtotime((new \DateTime($plane[$planeType]['scheduled']))->format('H:i:s'));
    $datetimeNow = strtotime(date('Y-m-d H:i:s'));
    $dateDiffSeconds = $datetimeNow - $datetimePlane;

    if($dateDiffSeconds < 0 || $dateDiffSeconds > $alertInSeconds) {
      return false;
    }

    $airport = new Airport($plane[$planeType]['airport'], $plane[$planeType]['iata']);

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