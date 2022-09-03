<?php

namespace Tests\presentation\controllers;

use App\domain\usecases\Airport;
use App\domain\usecases\FlightModel;
use App\domain\usecases\Flights;
use App\domain\usecases\FlightTypes;
use PHPUnit\Framework\TestCase;
use App\presentation\controllers\NotifyFlights;
use App\presentation\interfaces\Notifier;
use App\presentation\interfaces\FlightMessage;

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

    $notifierMock = $this->prophesize(Notifier::class);
    $flightsMessageMock = $this->prophesize(FlightMessage::class);

    $message = 'This is a example message!';
    $flightsMessageMock
      ->handle($flights[0])
      ->shouldBeCalledTimes(1)
      ->willReturn($message);

    $notifierMock
      ->notify($message)
      ->shouldBeCalledTimes(1)
      ->willReturn(true);

    $notifyFlights = new NotifyFlights(
      $notifierMock->reveal(),
      $flightsMessageMock->reveal(),
    );
    $notifyFlights->handle($flights);    
  }
}