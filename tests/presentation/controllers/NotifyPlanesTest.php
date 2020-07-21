<?php

namespace Tests\presentation\controllers;

use App\domain\usecases\Airport;
use App\domain\usecases\PlaneModel;
use App\domain\usecases\Planes;
use App\domain\usecases\PlaneTypes;
use PHPUnit\Framework\TestCase;
use App\presentation\controllers\NotifyPlanes;
use App\presentation\interfaces\Notifier;
use App\presentation\services\PlaneMessage;

class NotifyPlanesTest extends TestCase {

  public function testIfNotifierIsCalled() {
    $planes = new Planes();
    $planes->offsetSet(0, new PlaneModel(
      [
        'date' => '2020-07-19',
        'timeScheduled' => '2020-07-19T09:00:00+00:00',
        'timeEstimated' => '2020-07-19T10:00:00+00:00',
        'airline' => 'Airline A',
        'flightNumber' => 123,
        'type' => PlaneTypes::ARRIVAL,
        'airport' => new Airport('Guarulhos', 'GRU')
      ]
    ));

    $notifierMock = $this->prophesize(Notifier::class);
    $message = PlaneMessage::handle($planes[0]);
    $notifierMock
      ->notify($message)
      ->shouldBeCalledTimes(1)
      ->willReturn(true);
    $notifyPlanes = new NotifyPlanes($notifierMock->reveal());
    $notifyPlanes->handle($planes);    
  }
}