<?php

namespace Tests\presentation\services;

use App\domain\usecases\Airport;
use App\domain\usecases\FlightModel;
use App\domain\usecases\FlightTypes;
use PHPUnit\Framework\TestCase;
use App\presentation\services\FlightMessage;

class FlightMessageTest extends TestCase {

  public function testDepartureMessage() {
    $sut = new FlightMessage();

    $model = new FlightModel([
      'date' => '2020-07-21',
      'timeScheduled' => '2020-07-21T20:10:00+00:00',
      'timeEstimated' => '2020-07-21T20:10:00+00:00',
      'airline' => 'Airline A',
      'flightNumber' => 4689,
      'type' => FlightTypes::DEPARTURE,
      'airport' => new Airport('Hercilio Luz', 'FLN')
    ]);

    $this->assertEquals(
      $sut->handle($model),
      'Vôo 4689 da empresa Airline A vai PARTIR do aeroporto Hercilio Luz ás 20:10:00'
    );
  }

  public function testArrivalMessage() {
    $sut = new FlightMessage();

    $model = new FlightModel([
      'date' => '2020-07-21',
      'timeScheduled' => '2020-07-21T20:13:00+00:00',
      'timeEstimated' => '2020-07-21T20:13:00+00:00',
      'airline' => 'Airline B',
      'flightNumber' => 7786,
      'type' => FlightTypes::ARRIVAL,
      'airport' => new Airport('Hercilio José', 'FLN')
    ]);

    $this->assertEquals($sut->handle($model), 'Vôo 7786 da empresa Airline B vai CHEGAR no aeroporto Hercilio José ás 20:13:00');
  }
}