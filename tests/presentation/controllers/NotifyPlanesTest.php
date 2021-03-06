<?php

namespace Tests\presentation\controllers;

use App\domain\usecases\Airport;
use App\domain\usecases\PlaneModel;
use App\domain\usecases\Planes;
use App\domain\usecases\PlaneTypes;
use PHPUnit\Framework\TestCase;
use App\presentation\controllers\NotifyPlanes;
use App\presentation\interfaces\Notifier;
use App\presentation\interfaces\PlaneMessage;

class NotifyPlanesTest extends TestCase {

  public function testIfNotifierIsCalled() {
    $planes = new Planes();
    $planes->offsetSet(0, new PlaneModel(
      [
        'date' => '2020-07-19',
        'timeScheduled' => '2020-07-19T20:10:00+00:00',
        'timeEstimated' => '2020-07-19T20:15:00+00:00',
        'airline' => 'Lufthansa',
        'flightNumber' => 4689,
        'type' => PlaneTypes::DEPARTURE,
        'airport' => new Airport('Aeroporto Internacional Guarulhos', 'GRU')
      ]
    ));

    $notifierMock = $this->prophesize(Notifier::class);
    $planeMessageMock = $this->prophesize(PlaneMessage::class);

    $message = 'This is a example message!';
    $planeMessageMock
      ->handle($planes[0])
      ->shouldBeCalledTimes(1)
      ->willReturn($message);

    $notifierMock
      ->notify($message)
      ->shouldBeCalledTimes(1)
      ->willReturn(true);

    $notifyPlanes = new NotifyPlanes(
      $notifierMock->reveal(),
      $planeMessageMock->reveal(),
    );
    $notifyPlanes->handle($planes);    
  }
}