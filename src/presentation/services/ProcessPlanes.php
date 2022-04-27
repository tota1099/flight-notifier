<?php

namespace App\presentation\services;

use App\domain\usecases\Airport;
use App\domain\usecases\PlaneModel;
use App\domain\usecases\Planes;
use App\domain\usecases\PlaneTypes;
use App\presentation\exceptions\ProcessPlanesException;
use App\presentation\helpers\Helper;
use App\presentation\interfaces\Time;

class ProcessPlanes {

  private Time $timeService;
  private int $alertMinutes;
  private String $airportTargetIata;

  public function __construct(Time $timeService, int $alertMinutes, String $airportTargetIata)
  {
    $this->timeService = $timeService;
    $this->alertMinutes = $alertMinutes;
    $this->airportTargetIata = $airportTargetIata;
  }

  public function handle(String $data) {
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
      $planeType = PlaneTypes::ARRIVAL;
      if($plane['departure']['iata'] == $this->airportTargetIata ) {
        $planeType = PlaneTypes::DEPARTURE;
      }
      
      $diffMinutes = $this->timeService->getDiffInMinutes($this->timeService->convertRFC3339ToDatetime($plane[$planeType]['scheduled']), $this->timeService->now());

      if($diffMinutes > 0 && $this->alertMinutes >= $diffMinutes) {
        $planeProcessed = $this->processPlane($plane, $planeType);
        $planesToNotify->offsetSet($key, $planeProcessed);
      }
    }
    return $planesToNotify;
  }

  public function processPlane($plane, $planeType) {

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