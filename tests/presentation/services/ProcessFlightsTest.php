<?php

namespace Tests\presentation\services;

use App\domain\usecases\Airport;
use App\domain\usecases\FlightModel;
use App\domain\usecases\Flights;
use App\domain\usecases\FlightTypes;
use PHPUnit\Framework\TestCase;
use App\presentation\services\ProcessFlights;
use App\presentation\exceptions\ProcessFlightsException;
use App\presentation\interfaces\Time;

class ProcessFlightsTest extends TestCase {

  public function testItWithEmptyData() {
    $timeMock = $this->createMock(Time::class);
    $this->expectException(ProcessFlightsException::class);
    $this->expectExceptionMessage('Data param is required!');
    (new ProcessFlights($timeMock, 10, 'FLN'))->handle('');
  }

  public function testItWithInvalidDataType() {
    $timeMock = $this->createMock(Time::class);
    $this->expectException(ProcessFlightsException::class);
    $this->expectExceptionMessage('The param data needs to be a json!');
    (new ProcessFlights($timeMock, 10, 'FLN'))->handle('invalid_json');
  }

  public function testIfProcessFlightsToCorrectlyFormat() {
    $apiFlightsExample = file_get_contents(__DIR__ . "/flightsExample.txt");
    
    $nowMock = '2020-07-21 20:00:00';
    $flightsDate = '2020-07-21T20:10:00+00:00';
    $flightsDateTime = '2020-07-21 20:10:00';
    $notificationTime = 10;

    $timeMock = $this->createMock(Time::class);
    $timeMock
      ->expects($this->once())
      ->method('now')
      ->willReturn($nowMock);
    $timeMock
      ->expects($this->once())
      ->method('convertRFC3339ToDatetime')
      ->with($flightsDate)
      ->willReturn($flightsDateTime);
    $timeMock
      ->expects($this->once())
      ->method('getDiffInMinutes')
      ->with($flightsDateTime, $nowMock)
      ->willReturn($notificationTime);

    $flightsProcessed = (new ProcessFlights($timeMock, $notificationTime, 'FLN'))->handle($apiFlightsExample);
    $flights = new Flights();
    $flights->offsetSet(0, new FlightModel(
      [
        'date' => '2020-07-21',
        'timeScheduled' => $flightsDate,
        'timeEstimated' => $flightsDate,
        'airline' => 'Airline A',
        'flightNumber' => 4689,
        'type' => FlightTypes::DEPARTURE,
        'airport' => new Airport('Hercilio Luz', 'FLN')
      ]
    ));
    
    $this->assertInstanceOf(Flights::class, $flightsProcessed);
    $this->assertEquals($flights, $flightsProcessed);
  }
}