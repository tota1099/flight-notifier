<?php

namespace Tests\presentation\controllers;

use App\domain\models\Airport;
use App\domain\models\FlightModel;
use App\domain\models\Flights;
use App\domain\models\FlightTypes;
use PHPUnit\Framework\TestCase;
use App\presentation\controllers\NotifyFlights;
use App\presentation\interfaces\Notifier;
use App\presentation\interfaces\FlightMessage;
use App\domain\usecases\AddNotifierLog;
use App\domain\usecases\CheckLogByDateAndFlightNumber;

class NotifyFlightsTest extends TestCase {

  public function testIfNotifierIsCalled() {
    $flights = new Flights();
    $flights->offsetSet(0, new FlightModel(
      [
        'date' => '2020-07-19',
        'timeScheduled' => '2020-07-19T20:10:00+00:00',
        'timeEstimated' => '2020-07-19T20:15:00+00:00',
        'airline' => 'Lufthansa',
        'flightNumber' => 4689,
        'type' => FlightTypes::DEPARTURE,
        'airport' => new Airport('Aeroporto Internacional Guarulhos', 'GRU')
      ]
    ));

    $notifierMock = $this->createMock(Notifier::class);
    $flightsMessageMock = $this->createMock(FlightMessage::class);
    $checkLogByDateAndFlightNumber = $this->createMock(CheckLogByDateAndFlightNumber::class);
    $addNotifierLog = $this->createMock(AddNotifierLog::class);

    $message = 'This is a example message!';
    $flightsMessageMock
      ->expects($this->once())
      ->method('handle')
      ->with($flights[0])
      ->willReturn($message);

    $notifierMock
      ->expects($this->once())
      ->method('notify')
      ->with($message)
      ->willReturn(true);

    $notifyFlights = new NotifyFlights(
      $notifierMock,
      $addNotifierLog,
      $checkLogByDateAndFlightNumber,
      $flightsMessageMock,
    );
    $notifyFlights->handle($flights);    
  }
}