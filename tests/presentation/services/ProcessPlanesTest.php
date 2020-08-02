<?php

namespace Tests\presentation\services;

use App\domain\usecases\Airport;
use App\domain\usecases\PlaneModel;
use App\domain\usecases\Planes;
use App\domain\usecases\PlaneTypes;
use PHPUnit\Framework\TestCase;
use App\presentation\services\ProcessPlanes;
use App\presentation\exceptions\ProcessPlanesException;
use App\presentation\interfaces\Time;

class ProcessPlanesTest extends TestCase {

  public function testItWithEmptyData() {
    $timeMock = $this->prophesize(Time::class);
    $this->expectException(ProcessPlanesException::class);
    $this->expectExceptionMessage('Data param is required!');
    (new ProcessPlanes($timeMock->reveal(), 10, 'FLN'))->handle('');
  }

  public function testItWithInvalidDataType() {
    $timeMock = $this->prophesize(Time::class);
    $this->expectException(ProcessPlanesException::class);
    $this->expectExceptionMessage('The param data needs to be a json!');
    (new ProcessPlanes($timeMock->reveal(), 10, 'FLN'))->handle('invalid_json');
  }

  public function testIfProcessPlanesToCorrectlyFormat() {
    $apiPlanesExample = file_get_contents(__DIR__ . "/planesExample.txt");
    
    $nowMock = '2020-07-21 20:00:00';
    $planeDate = '2020-07-21T20:10:00+00:00';
    $planeDateTime = '2020-07-21 20:10:00';
    $notificationTime = 10;

    $timeMock = $this->prophesize(Time::class);
    $timeMock
      ->now()
      ->shouldBeCalledTimes(1)
      ->willReturn($nowMock);
    $timeMock
      ->convertRFC3339ToDatetime($planeDate)
      ->shouldBeCalledTimes(1)
      ->willReturn($planeDateTime);
    $timeMock
      ->getDiffInMinutes($planeDateTime, $nowMock)
      ->shouldBeCalledTimes(1)
      ->willReturn($notificationTime);

    $planesProcessed = (new ProcessPlanes($timeMock->reveal(), $notificationTime, 'FLN'))->handle($apiPlanesExample);
    $planes = new Planes();
    $planes->offsetSet(0, new PlaneModel(
      [
        'date' => '2020-07-21',
        'timeScheduled' => $planeDate,
        'timeEstimated' => $planeDate,
        'airline' => 'Airline A',
        'flightNumber' => 4689,
        'type' => PlaneTypes::DEPARTURE,
        'airport' => new Airport('Hercilio Luz', 'FLN')
      ]
    ));
    
    $this->assertInstanceOf(Planes::class, $planesProcessed);
    $this->assertEquals($planes, $planesProcessed);
  }
}