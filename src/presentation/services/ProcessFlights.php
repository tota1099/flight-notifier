<?php

namespace App\presentation\services;

use App\domain\models\Airport;
use App\domain\models\FlightModel;
use App\domain\models\Flights;
use App\domain\models\FlightTypes;
use App\presentation\exceptions\ProcessFlightsException;
use App\presentation\helpers\Helper;
use App\presentation\interfaces\Time;

class ProcessFlights {

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
      throw new ProcessFlightsException('Data param is required!');
    }
    if(!Helper::isValidJson($data)){
      throw new ProcessFlightsException('The param data needs to be a json!');
    }

    $flights = json_decode($data, true);
    $flightsToNotify = new Flights();
    foreach($flights as $key => $flights) {
      $flightsType = FlightTypes::ARRIVAL;
      if($flights['departure']['iata'] == $this->airportTargetIata ) {
        $flightsType = FlightTypes::DEPARTURE;
      }
      
      $diffMinutes = $this->timeService->getDiffInMinutes($this->timeService->convertRFC3339ToDatetime($flights[$flightsType]['scheduled']), $this->timeService->now());

      if($diffMinutes > 0 && $this->alertMinutes >= $diffMinutes) {
        $flightsProcessed = $this->processFlight($flights, $flightsType);
        $flightsToNotify->offsetSet($key, $flightsProcessed);
      }
    }
    return $flightsToNotify;
  }

  public function processFlight($flights, $flightsType) {

    $airport = new Airport($flights[$flightsType]['airport'], $flights[$flightsType]['iata']);

    return new FlightModel([
      'date' => $flights['flight_date'],
      'timeScheduled' => $flights[$flightsType]['scheduled'],
      'timeEstimated' => $flights[$flightsType]['estimated'],
      'airline' => $flights['airline']['name'],
      'flightNumber' => $flights['flight']['number'],
      'type' => $flightsType,
      'airport' => $airport
    ]);
  }
}