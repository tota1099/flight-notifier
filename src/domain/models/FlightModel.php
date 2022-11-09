<?php

namespace App\domain\models;

class FlightModel {
  public string $date; 
  public string $timeScheduled;
  public string $timeEstimated;
  public string $airline;
  public int $flightNumber;
  public string $type;
  public AirPort $airport;

  public function __construct($flightsData = [])
  {
    $this->date = $flightsData['date'];  
    $this->timeScheduled = $flightsData['timeScheduled'];
    $this->timeEstimated = $flightsData['timeEstimated'];
    $this->airline = $flightsData['airline'];
    $this->flightNumber = $flightsData['flightNumber'];
    $this->type = $flightsData['type'];
    $this->airport = $flightsData['airport'];
  }
}