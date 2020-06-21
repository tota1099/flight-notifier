<?php

namespace App\domain\usecases;

class PlaneModel {
  public string $date; 
  public string $timeScheduled;
  public string $timeEstimated;
  public string $airline;
  public int $flightNumber;
  public string $type;
  public AirPort $airport;

  public function __construct($planeData = [])
  {
    $this->date = $planeData['date'];  
    $this->timeScheduled = $planeData['timeScheduled'];
    $this->timeEstimated = $planeData['timeEstimated'];
    $this->airline = $planeData['airline'];
    $this->flightNumber = $planeData['flightNumber'];
    $this->type = $planeData['type'];
    $this->airport = $planeData['airport'];
  }
}