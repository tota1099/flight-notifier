<?php

namespace Tests\presentation\controllers;

use PHPUnit\Framework\TestCase;
use App\presentation\helpers\TimeHelper;

class TimeHelperTest extends TestCase {

  public function testDiffInMinutes() {
    $date1 = (new \DateTime('01/12/2022 10:34 AM'))->format('Y-m-d  H:i:s');
    $date2 = (new \DateTime('01/12/2022 10:00 AM'))->format('Y-m-d  H:i:s');

    $sut = new TimeHelper();
    $this->assertEquals($sut->getDiffInMinutes($date1, $date2), 34);

    $date1 = (new \DateTime('01/12/2022 10:01 AM'))->format('Y-m-d  H:i:s');
    $date2 = (new \DateTime('01/12/2022 08:04 AM'))->format('Y-m-d  H:i:s');

    $this->assertEquals($sut->getDiffInMinutes($date1, $date2), 117);
  }
}