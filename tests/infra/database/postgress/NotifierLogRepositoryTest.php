<?php

namespace tests\infra\db\account;

use App\domain\usecases\FlightModel;
use App\infra\database\postgres\NotifierLogRepository;
use App\domain\usecases\FlightTypes;
use App\domain\usecases\Airport;
use App\domain\usecases\AddNotifierLog;
use PHPUnit\Framework\TestCase;

final class NotifierLogRepositoryTest extends TestCase
{
  public NotifierLogRepository $sut;
  private \Faker\Generator $faker;

  public function setUp() : void {
    $this->sut = new NotifierLogRepository();
    $this->faker = \Faker\Factory::create();
  }

  public function testShouldReturnTheNotifierRecentlyAdded() {
    $airport = new Airport($this->faker->name(), $this->faker->name());
    $flight = [
      "date" => $this->faker->date(),
      "timeScheduled" => $this->timeScheduled = $this->faker->date(),
      "timeEstimated" => $this->faker->date(),
      "airline" => $this->faker->name(),
      "flightNumber" => $this->faker->numberBetween(1000, 9000),
      "type" => FlightTypes::DEPARTURE,
      "airport" => $airport
    ];

    $anydate = $this->faker->date();
    $addNotifierLog = new AddNotifierLog(new FlightModel($flight), $anydate);
    $logAdded = $this->sut->add($addNotifierLog);
    
    $logAdded = $this->sut->getById($logAdded->id);

    $this->assertIsInt($logAdded->id);
    $this->assertEquals($logAdded->date, $anydate);
    $this->assertEquals($logAdded->flightNumber, $flight["flightNumber"]);
  }
}